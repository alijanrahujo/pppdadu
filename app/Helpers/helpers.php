<?php

if (! function_exists('media_asset')) {
    /**
     * Resolve media URL for uploaded files or local static assets.
     */
    function media_asset(?string $path, string $fallback = 'Assets/images/pir-mujeeb.jpg'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/') || file_exists(public_path('storage/'.$path))) {
            return asset('storage/'.$path);
        }

        if (file_exists(public_path('Assets/images/'.$path))) {
            return asset('Assets/images/'.$path);
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return asset($path);
    }
}
