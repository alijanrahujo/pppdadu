const CACHE_NAME = 'ppp-dadu-pwa-v1';
const OFFLINE_URL = '/offline.html';

const PRECACHE_ASSETS = [
    '/',
    '/manifest.json',
    '/offline.html',
    '/pwa/icon-192x192.png',
    '/pwa/icon-512x512.png',
    '/pwa/apple-touch-icon.png',
    '/Assets/images/PPP-1024x564.png',
    '/Assets/css/bootstrap.css',
    '/Assets/css/all.css',
    '/css/site.css',
    '/Assets/js/jquery.min.js',
    '/Assets/js/bootstrap.bundle.min.js',
    '/js/site.js'
];

// Install: Cache critical shell assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS).catch((err) => {
                console.warn('PWA Precache failed for some assets:', err);
            });
        }).then(() => self.skipWaiting())
    );
});

// Activate: Clean up older cache versions
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Strategy
self.addEventListener('fetch', (event) => {
    const request = event.request;
    const url = new URL(request.url);

    // Ignore non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    // Do not cache administrative or backend routes
    if (url.pathname.startsWith('/admin') || url.pathname.startsWith('/login') || url.pathname.startsWith('/logout')) {
        return;
    }

    // Navigation requests (HTML pages) -> Network First with Offline Fallback
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const copy = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return networkResponse;
                })
                .catch(async () => {
                    const cachedResponse = await caches.match(request);
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    const offlinePage = await caches.match(OFFLINE_URL);
                    return offlinePage || new Response('Offline', { status: 503, headers: { 'Content-Type': 'text/plain' } });
                })
        );
        return;
    }

    // Static assets (CSS, JS, Fonts, Images) -> Cache First with Network Fallback
    if (
        url.pathname.startsWith('/Assets/') ||
        url.pathname.startsWith('/css/') ||
        url.pathname.startsWith('/js/') ||
        url.pathname.startsWith('/pwa/') ||
        request.destination === 'style' ||
        request.destination === 'script' ||
        request.destination === 'image' ||
        request.destination === 'font'
    ) {
        event.respondWith(
            caches.match(request).then((cachedResponse) => {
                if (cachedResponse) {
                    // Update cache in background
                    fetch(request).then((networkResponse) => {
                        if (networkResponse && networkResponse.status === 200) {
                            caches.open(CACHE_NAME).then((cache) => cache.put(request, networkResponse));
                        }
                    }).catch(() => {});
                    return cachedResponse;
                }

                return fetch(request).then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const copy = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return networkResponse;
                });
            })
        );
        return;
    }

    // Default network fetch with cache fallback
    event.respondWith(
        fetch(request).catch(() => caches.match(request))
    );
});
