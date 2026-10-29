<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\GalleryItem;
use App\Models\Leader;
use App\Models\Membership;
use App\Models\SiteSetting;
use App\Models\UnionCouncil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class PublicPageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Page Actions
    |--------------------------------------------------------------------------
    */

    /**
     * Show the dynamic homepage.
     */
    public function home()
    {
        $hero = SiteSetting::getGroup('home_hero');
        $values = SiteSetting::get('home.values', $this->defaultHomeValues());
        $profile = SiteSetting::getGroup('home_profile');
        $about = SiteSetting::getGroup('home_about');
        $join = SiteSetting::getGroup('home_join');

        $leadershipSlides = $this->getHomeLeadershipSlides();
        $activitySlides = $this->getHomeActivitySlides();
        $blogSlides = $this->getHomeBlogSlides();

        return view('home', compact(
            'hero',
            'values',
            'profile',
            'about',
            'join',
            'leadershipSlides',
            'activitySlides',
            'blogSlides'
        ));
    }

    /**
     * Show the District President profile page.
     */
    public function showPresident()
    {
        $settings = SiteSetting::getGroup('page_president');

        $page = [
            'type' => 'profile',
            'layout' => 'president',
            'title' => $settings['president.title'] ?? 'About Our President',
            'eyebrow' => $settings['president.eyebrow'] ?? 'District leadership',
            'subtitle' => $settings['president.name'] ?? 'Barrister Pir Mujeeb-ul-Haq',
            'image' => $settings['president.image'] ?? 'mujeepir-1024x1024.png',
            'image_alt' => $settings['president.name'] ?? 'Barrister Pir Mujeeb-ul-Haq',
            'role' => $settings['president.role'] ?? 'MPA and District President, Pakistan Peoples Party District Dadu',
            'description' => $settings['president.description'] ?? 'Barrister Pir Mujeeb-ul-Haq is the District President of Pakistan Peoples Party District Dadu...',
            'principles' => $settings['president.principles'] ?? ["Advocate for People's Rights", 'Development Focused', 'Democracy & Justice', 'Community First'],
            'quote' => $settings['president.quote'] ?? 'Leadership is not about power, it is about responsibility and service to people.',
            'statement' => $settings['president.statement'] ?? "<p>“My mission is to serve the people of Dadu with honesty, transparency and dedication, and to build a stronger, progressive and united society.”</p>\n<cite>- Barrister Pir Mujeeb-ul-Haq</cite>\n<span>President, PPP District Dadu</span>",
            'mission' => $settings['president.mission'] ?? 'To serve the people of Dadu with honesty, transparency and dedication...',
            'vision' => $settings['president.vision'] ?? 'A democratic, peaceful and prosperous Dadu where every citizen has equal opportunities...',
            'achievements' => $settings['president.achievements'] ?? [],
            'journey' => $settings['president.journey'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the General Secretary profile page.
     */
    public function showGeneralSecretary()
    {
        $settings = SiteSetting::getGroup('page_general_secretary');
        $name = $settings['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah';
        $role = $settings['general_secretary.role'] ?? 'General Secretary, Pakistan Peoples Party District Dadu';
        $quote = $settings['general_secretary.quote'] ?? 'Our strength lies in our unity and our connection with the people. Together, we can build a stronger, progressive and prosperous Dadu.';

        $page = [
            'type' => 'profile',
            'layout' => 'general-secretary',
            'title' => $settings['general_secretary.title'] ?? 'About Our General Secretary',
            'eyebrow' => $settings['general_secretary.eyebrow'] ?? 'District leadership',
            'subtitle' => $name,
            'image' => $settings['general_secretary.image'] ?? 'gc-1024x1024.png',
            'image_alt' => $name,
            'role' => $role,
            'description' => $settings['general_secretary.description'] ?? '<p>Syed Naveed Ahmed Shah is a committed party leader and an energetic organizer who works day and night for the strengthening of PPP in District Dadu.</p><p>He believes in teamwork, dedication and discipline and is focused on bringing the party vision to every corner of the district.</p>',
            'principles' => $settings['general_secretary.principles'] ?? ['Strong Leadership', 'Party Organization', 'Public Service', 'Youth Empowerment'],
            'quote' => $quote,
            'statement' => $settings['general_secretary.statement'] ?? ("<p>“{$quote}”</p>\n<cite>- {$name}</cite>\n<span>{$role}</span>"),
            'commitments' => $settings['general_secretary.commitments'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the overall party leadership page.
     */
    public function showLeadership()
    {
        $settings = SiteSetting::getGroup('page_leadership');
        $leadersList = Leader::active()->get();

        $members = $leadersList->map(fn (Leader $m) => [
            'name' => $m->name,
            'role' => $m->role,
            'district' => $m->district ?: 'District Dadu',
            'image_url' => $m->image_url,
            'link' => $m->link,
        ])->all();

        if (empty($members)) {
            $members = $this->defaultLeadershipMembers();
        }

        $page = [
            'type' => 'directory',
            'layout' => 'leadership',
            'title' => $settings['leadership.title'] ?? 'Our Leadership',
            'eyebrow' => $settings['leadership.eyebrow'] ?? 'Party Leadership',
            'subtitle' => $settings['leadership.subtitle'] ?? 'Our Leadership',
            'description' => $settings['leadership.description'] ?? 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu under our inspiring leadership.',
            'members' => $members,
            'principles' => $settings['leadership.principles'] ?? [
                ['title' => 'Democracy & Equality', 'description' => 'Unshakable faith in democratic values, constitutional rule and equal rights for all citizens.', 'icon' => 'fa-landmark'],
                ['title' => 'Public Service', 'description' => 'Dedicated to uplifting vulnerable citizens, rural communities and laborers across District Dadu.', 'icon' => 'fa-people-roof'],
                ['title' => 'Social Justice', 'description' => 'Eliminating disparity, safeguarding human rights, and expanding healthcare and education access.', 'icon' => 'fa-scale-balanced'],
                ['title' => 'Youth & Women Empowerment', 'description' => 'Providing progressive platforms and leadership roles for young activists and women in political life.', 'icon' => 'fa-handshake-angle'],
            ],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the District Body directory page.
     */
    public function showDistrictBody()
    {
        $settings = SiteSetting::getGroup('page_district_body');
        $leadersList = Leader::active()->districtBody()->get();

        $members = $leadersList->map(fn (Leader $m) => [
            'name' => $m->name,
            'role' => $m->role,
            'image_url' => $m->image_url,
            'link' => $m->link,
        ])->all();

        if (empty($members)) {
            $members = $this->defaultDistrictBodyMembers();
        }

        $page = [
            'type' => 'directory',
            'layout' => 'district-body',
            'title' => $settings['district_body.title'] ?? 'District Body',
            'eyebrow' => $settings['district_body.eyebrow'] ?? 'Party organization',
            'subtitle' => $settings['district_body.subtitle'] ?? 'District Body',
            'description' => $settings['district_body.description'] ?? 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu.',
            'members' => $members,
            'principles' => $settings['district_body.principles'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show Tehsil Bodies across the district.
     */
    public function showTehsilBodies()
    {
        $settings = SiteSetting::getGroup('page_tehsil_bodies');

        $page = [
            'type' => 'organization',
            'layout' => 'tehsil-bodies',
            'title' => $settings['tehsil_bodies.title'] ?? 'Tehsil Bodies',
            'eyebrow' => $settings['tehsil_bodies.eyebrow'] ?? 'Grassroots Organization',
            'subtitle' => $settings['tehsil_bodies.subtitle'] ?? 'Working for the People across All 4 Tehsils of District Dadu',
            'description' => $settings['tehsil_bodies.description'] ?? '<p>Pakistan Peoples Party has a robust grassroots organizational network spread across all four tehsils of District Dadu: <strong>Dadu</strong>, <strong>Mehar</strong>, <strong>Khairpur Nathan Shah</strong>, and <strong>Johi</strong>.</p><p>Our dedicated Tehsil office bearers work relentlessly to mobilize party workers, address local community issues, and implement the progressive vision of our leadership at the town and village level.</p>',
            'statistics' => $settings['tehsil_bodies.statistics'] ?? $this->defaultTehsilStatistics(),
            'tehsils' => $settings['tehsil_bodies.tehsils'] ?? $this->defaultTehsils(),
            'priorities' => $settings['tehsil_bodies.priorities'] ?? $this->defaultTehsilPriorities(),
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show Municipal & Town Bodies.
     */
    public function showMunicipalBodies()
    {
        $settings = SiteSetting::getGroup('page_municipal_bodies');

        $page = [
            'type' => 'municipal',
            'layout' => 'municipal-bodies',
            'title' => $settings['municipal_bodies.title'] ?? 'Municipal & Town Bodies',
            'eyebrow' => $settings['municipal_bodies.eyebrow'] ?? 'Local organization',
            'subtitle' => $settings['municipal_bodies.subtitle'] ?? 'Working for stronger communities',
            'description' => $settings['municipal_bodies.description'] ?? 'Municipal and town bodies play a vital role...',
            'statistics' => $settings['municipal_bodies.statistics'] ?? [],
            'priorities' => $settings['municipal_bodies.priorities'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show Union Council Bodies & Members.
     */
    public function showUnionCouncilBodies()
    {
        $settings = SiteSetting::getGroup('page_union_councils');
        $councils = UnionCouncil::query()->orderBy('order')->orderBy('id')->get()->toArray();

        $page = [
            'type' => 'councils',
            'layout' => 'union-councils',
            'title' => $settings['union_councils.title'] ?? 'Union Council Bodies & Members',
            'eyebrow' => $settings['union_councils.eyebrow'] ?? 'Grassroots organization',
            'subtitle' => $settings['union_councils.subtitle'] ?? 'Our Union Councils are the strength of our organization...',
            'councils' => $councils,
            'statistics' => SiteSetting::get('municipal_bodies.statistics', []),
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the Media & Activities Gallery.
     */
    public function showMediaGallery()
    {
        $items = GalleryItem::query()->orderBy('order')->orderByDesc('id')->get();

        $images = $items->map(fn (GalleryItem $item) => [
            'file' => $item->image,
            'alt' => $item->alt ?? $item->title ?? 'Activity photo',
            'title' => $item->title ?? '',
            'category' => $item->category,
        ])->all();

        $page = [
            'type' => 'gallery',
            'layout' => 'media-gallery',
            'title' => 'Media Gallery',
            'eyebrow' => 'Our activities',
            'subtitle' => 'Moments from our activities',
            'images' => $images,
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show published blogs & news with search and category filtering.
     */
    public function showBlogs(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $query = Blog::query()->published();

        if (! empty($search)) {
            $search = trim((string) $search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (! empty($category) && $category !== 'all') {
            $query->where('category', $category);
        }

        $blogs = $query->paginate(9)->withQueryString();

        $featuredBlog = Blog::published()->where('is_featured', true)->first();
        if (! $featuredBlog && $blogs->isNotEmpty()) {
            $featuredBlog = $blogs->first();
        }

        $categories = Blog::where('is_published', true)->distinct()->pluck('category')->filter()->values()->all();
        if (empty($categories)) {
            $categories = ['Development & Welfare', 'Party News', 'Press Releases', 'Speeches & Statements', 'Youth & Community'];
        }

        $recentPosts = Blog::published()->take(4)->get();

        $page = [
            'type' => 'blogs',
            'layout' => 'blogs',
            'title' => 'Blogs & News',
            'eyebrow' => 'Latest Updates',
            'subtitle' => 'Official news, developmental updates, statements and stories from Pakistan Peoples Party District Dadu.',
            'blogs' => $blogs,
            'featuredBlog' => $featuredBlog,
            'categories' => $categories,
            'search' => $search,
            'currentCategory' => $category,
            'recentPosts' => $recentPosts,
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show a single blog post and track its view count.
     */
    public function showBlogPost(string $slug)
    {
        $blog = Blog::published()->where('slug', $slug)->firstOrFail();

        $blog->increment('views_count');

        $relatedPosts = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Blog::published()
                ->where('id', '!=', $blog->id)
                ->take(3)
                ->get();
        }

        $page = [
            'type' => 'blog-post',
            'layout' => 'blog-post',
            'title' => $blog->title,
            'eyebrow' => $blog->category,
            'subtitle' => $blog->excerpt,
            'blog' => $blog,
            'relatedPosts' => $relatedPosts,
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show registered members area directory with search and wing filters.
     */
    public function showMembers(Request $request)
    {
        $settings = SiteSetting::getGroup('page_members_area');
        $search = $request->query('search');
        $wing = $request->query('wing');
        $city = $request->query('city');

        $query = Membership::query()->where('status','approved')->latest();

        if (! empty($search)) {
            $search = trim((string) $search);
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('tehsil_city', 'like', "%{$search}%")
                    ->orWhere('profession', 'like', "%{$search}%")
                    ->orWhere('member_type', 'like', "%{$search}%");
            });
        }

        if (! empty($wing) && $wing !== 'all') {
            $query->where('member_type', $wing);
        }

        if (! empty($city) && $city !== 'all') {
            $query->where('tehsil_city', $city);
        }

        $members = $query->paginate(12)->withQueryString();

        $stats = [
            'total' => Membership::where('status','approved')->count(),
            'primary' => Membership::where(['status'=>'approved','member_type'=>'Primary Member'])->count(),
            'youth' => Membership::where(['status'=>'approved','member_type'=>'Youth Wing'])->count(),
            'women' => Membership::where(['status'=>'approved','member_type'=>'Women Wing'])->count(),
        ];

        $page = [
            'type' => 'members',
            'layout' => 'members',
            'title' => $settings['members.title'] ?? 'Members Area',
            'eyebrow' => $settings['members.eyebrow'] ?? 'Our Strength',
            'subtitle' => $settings['members.subtitle'] ?? 'Registered members and volunteers of Pakistan Peoples Party District Dadu.',
            'members' => $members,
            'stats' => $stats,
            'search' => $search,
            'wing' => $wing,
            'city' => $city,
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the online membership application form page.
     */
    public function showMembership()
    {
        $settings = SiteSetting::getGroup('page_join');

        $page = [
            'type' => 'membership',
            'layout' => 'membership',
            'title' => $settings['join.title'] ?? 'Join (Online Membership)',
            'eyebrow' => $settings['join.eyebrow'] ?? 'Be a part of change',
            'subtitle' => $settings['join.subtitle'] ?? 'Become a part of Pakistan Peoples Party District Dadu...',
            'principles' => $settings['join.principles'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the public contact and suggestions page.
     */
    public function showContact()
    {
        $settings = SiteSetting::getGroup('page_contact');

        $page = [
            'type' => 'contact',
            'layout' => 'contact',
            'title' => $settings['contact.title'] ?? 'Suggestions / Complaints / Contacts',
            'eyebrow' => $settings['contact.eyebrow'] ?? 'We are listening',
            'subtitle' => $settings['contact.subtitle'] ?? 'Have a suggestion or concern to share? Send a message...',
            'principles' => $settings['contact.principles'] ?? [],
        ];

        return view('pages.show', ['page' => $page]);
    }

    /*
    |--------------------------------------------------------------------------
    | Submission Handlers
    |--------------------------------------------------------------------------
    */

    /**
     * Handle membership registration submission.
     */
    public function storeMembership(Request $request): RedirectResponse
    {
        $this->normalizeMembershipInput($request);

        $validator = Validator::make($request->all(), [
            'member_type' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'string', 'max:50'],
            'profile_picture' => ['nullable', 'file', 'image', 'max:5120'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email_address' => ['required', 'email', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:30'],
            'cnic_number' => ['required', 'string', 'regex:/^\d{5}-?\d{7}-?\d$/'],
            'date_of_birth' => ['required', 'date', 'before:tomorrow'],
            'education' => ['required', 'string', 'max:100'],
            'profession' => ['required', 'string', 'max:100'],
            'resident_type' => ['required', 'string', 'max:50'],
            'province' => ['required', 'string', 'max:100'],
            'division' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'tehsil_city' => ['required', 'string', 'max:100'],
            'current_address' => ['required', 'string', 'max:1000'],
            'permanent_address' => ['required', 'string', 'max:1000'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'tiktok_url' => ['nullable', 'string', 'max:255'],
            'volunteering' => ['nullable', 'array'],
            'volunteering.*' => ['string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = $validator->validated();

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $data['profile_picture'] = $request->file('profile_picture')->store('memberships', 'public');
        }

        $data['full_name'] = trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? ''));
        $data['address'] = $data['current_address'] ?? '';
        $data['city'] = $data['tehsil_city'] ?? '';

        if (isset($data['cnic_number'])) {
            $data['cnic_number'] = str_replace('-', '', $data['cnic_number']);
        }

        Membership::query()->create([
            'member_type' => $data['member_type'] ?? null,
            'gender' => $data['gender'] ?? null,
            'profile_picture' => $data['profile_picture'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'email_address' => $data['email_address'] ?? null,
            'mobile_number' => $data['mobile_number'] ?? null,
            'cnic_number' => $data['cnic_number'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'education' => $data['education'] ?? null,
            'profession' => $data['profession'] ?? null,
            'resident_type' => $data['resident_type'] ?? 'Pakistani',
            'province' => $data['province'] ?? null,
            'division' => $data['division'] ?? null,
            'district' => $data['district'] ?? null,
            'tehsil_city' => $data['tehsil_city'] ?? null,
            'current_address' => $data['current_address'] ?? null,
            'permanent_address' => $data['permanent_address'] ?? null,
            'facebook_url' => $data['facebook_url'] ?? null,
            'twitter_url' => $data['twitter_url'] ?? null,
            'instagram_url' => $data['instagram_url'] ?? null,
            'tiktok_url' => $data['tiktok_url'] ?? null,
            'volunteering' => $data['volunteering'] ?? [],
            'status' => 'new',
            'is_read' => false,
        ]);

        return back()->with('status', 'Your membership application has been received.');
    }

    /**
     * Handle public contact / suggestion submission.
     */
    public function storeContact(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:150'],
            'cnic_number' => ['required', 'string', 'regex:/^\d{5}-?\d{7}-?\d$/'],
            'email_address' => ['nullable', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'contact_type' => ['required', 'in:Suggestion,Complaint,General inquiry'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = $validator->validated();

        if (isset($data['cnic_number'])) {
            $data['cnic_number'] = str_replace('-', '', $data['cnic_number']);
        }

        Contact::query()->create([
            'full_name' => $data['full_name'],
            'cnic_number' => $data['cnic_number'],
            'email_address' => $data['email_address'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
            'contact_type' => $data['contact_type'] ?? 'General inquiry',
            'message' => $data['message'],
            'status' => 'new',
            'is_read' => false,
        ]);

        return back()->with('status', 'Your message has been received.');
    }

    /*
    |--------------------------------------------------------------------------
    | Backward Compatibility & Page Routing
    |--------------------------------------------------------------------------
    */

    /**
     * Dynamic slug-based page dispatcher for backward compatibility.
     */
    public function page(string $slug)
    {
        return match ($slug) {
            'president' => $this->showPresident(),
            'general-secretary' => $this->showGeneralSecretary(),
            'district-body' => $this->showDistrictBody(),
            'leadership' => $this->showLeadership(),
            'tehsil-bodies', 'tahseel-bodies', 'taseel-bodies' => $this->showTehsilBodies(),
            'municipal-bodies' => $this->showMunicipalBodies(),
            'union-council-bodies' => $this->showUnionCouncilBodies(),
            'media-gallery' => $this->showMediaGallery(),
            'members-area', 'members' => $this->showMembers(request()),
            'join' => $this->showMembership(),
            'contact' => $this->showContact(),
            default => abort(404),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Private Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Normalize legacy membership input fields before validation.
     */
    private function normalizeMembershipInput(Request $request): void
    {
        if (! $request->filled('first_name') && $request->filled('full_name')) {
            $parts = explode(' ', trim((string) $request->input('full_name')), 2);
            $request->merge([
                'first_name' => $parts[0] ?? '',
                'last_name' => $parts[1] ?? ($parts[0] ?? ''),
            ]);
        }

        if (! $request->filled('current_address') && $request->filled('address')) {
            $request->merge([
                'current_address' => $request->input('address'),
                'permanent_address' => $request->input('permanent_address', $request->input('address')),
            ]);
        }

        if (! $request->filled('tehsil_city') && $request->filled('city')) {
            $request->merge([
                'tehsil_city' => $request->input('city'),
            ]);
        }

        if (! $request->filled('member_type')) {
            $request->merge(['member_type' => 'Primary Member']);
        }

        if (! $request->filled('resident_type')) {
            $request->merge(['resident_type' => 'Pakistani']);
        }

        if (! $request->filled('province')) {
            $request->merge(['province' => 'Sindh']);
        }

        if (! $request->filled('division')) {
            $request->merge(['division' => 'Hyderabad']);
        }

        if (! $request->filled('district')) {
            $request->merge(['district' => 'Dadu']);
        }
    }

    /**
     * Homepage leadership carousel slides.
     */
    private function getHomeLeadershipSlides(): Collection
    {
        $leaders = Leader::active()->slider()->get();

        if ($leaders->isEmpty()) {
            $leaders = collect([
                new Leader(['image' => 'pir-mujeeb.jpg', 'name' => 'Pir Mujeeb-ul-Haq', 'role' => 'District President']),
                new Leader(['image' => 'rashid-ali-1.jpg', 'name' => 'Syed Rashid Ali Shah', 'role' => 'Senior Vice President']),
                new Leader(['image' => 'irfanshah.jpg', 'name' => 'Syed Irfan Shah', 'role' => 'Vice President']),
                new Leader(['image' => 'naeem-bhotto.jpg', 'name' => 'Naeem Bhutto', 'role' => 'General Secretary']),
            ]);
        }

        return $leaders->chunk(4);
    }

    /**
     * Homepage activity carousel slides.
     */
    private function getHomeActivitySlides(): Collection
    {
        $featured = GalleryItem::featured()->get();

        if ($featured->isEmpty()) {
            $featured = GalleryItem::query()->take(8)->get();
        }

        return $featured->isNotEmpty() ? $featured->chunk(4) : collect();
    }

    /**
     * Homepage latest blog carousel slides.
     */
    private function getHomeBlogSlides(): Collection
    {
        $latest = Blog::published()->take(9)->get();

        return $latest->isNotEmpty() ? $latest->chunk(3) : collect();
    }

    /**
     * Default homepage core party values.
     *
     * @return array<int, array<string, string>>
     */
    private function defaultHomeValues(): array
    {
        return [
            ['title' => 'Serving the people', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-people-group', 'color' => 'green'],
            ['title' => 'Social justice', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-scale-balanced', 'color' => 'black'],
            ['title' => 'Democracy', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-book-open', 'color' => 'red'],
            ['title' => 'Unity & Faith', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-handshake-angle', 'color' => 'green'],
        ];
    }

    /**
     * Default fallback leadership list.
     *
     * @return array<int, array<string, string|null>>
     */
    private function defaultLeadershipMembers(): array
    {
        return [
            ['name' => 'Shaheed Zulfikar Ali Bhutto', 'role' => 'Founder & Quaid-e-Awam', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/1-1024x1024.png'), 'link' => null],
            ['name' => 'Shaheed Mohtarma Benazir Bhutto', 'role' => 'Shaheed-e-Jamhooriat', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/2-1024x1024.png'), 'link' => null],
            ['name' => 'President Asif Ali Zardari', 'role' => 'President of Pakistan', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/3-1024x1024.png'), 'link' => null],
            ['name' => 'Chairman Bilawal Bhutto Zardari', 'role' => 'Chairman, Pakistan Peoples Party', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/4-1024x1024.png'), 'link' => null],
            ['name' => 'Barrister Pir Mujeeb-ul-Haq', 'role' => 'District President', 'district' => 'District Dadu', 'image_url' => asset('Assets/images/mujeepir-1024x1024.png'), 'link' => route('pages.president')],
            ['name' => 'Syed Naveed Ahmed Shah', 'role' => 'General Secretary', 'district' => 'District Dadu', 'image_url' => asset('Assets/images/gc-1024x1024.png'), 'link' => route('pages.general-secretary')],
        ];
    }

    /**
     * Default fallback district body members.
     *
     * @return array<int, array<string, string>>
     */
    private function defaultDistrictBodyMembers(): array
    {
        return [
            ['name' => 'Barrister Pir Mujeeb-ul-Haq', 'role' => 'District President', 'image_url' => asset('Assets/images/mujeepir-1024x1024.png'), 'link' => route('pages.president')],
            ['name' => 'Syed Naveed Ahmed Shah', 'role' => 'General Secretary', 'image_url' => asset('Assets/images/gc-1024x1024.png'), 'link' => route('pages.general-secretary')],
        ];
    }

    /**
     * Default tehsil organizational bodies and committee members.
     *
     * @return array<int, array<string, mixed>>
     */
    private function defaultTehsils(): array
    {
        return [
            [
                'name' => 'Tehsil Dadu',
                'urdu_name' => 'تحصیل دادو',
                'tagline' => 'District Headquarters & Central Hub',
                'description' => 'Covering Dadu city and surrounding rural union councils with active party leadership dedicated to public welfare and infrastructure.',
                'image' => 'Assets/images/images.jpg',
                'members' => [
                    ['role' => 'President', 'name' => 'Syed Zafar Ali Shah', 'phone' => '025-4551234', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'General Secretary', 'name' => 'Muhammad Aslam Panhwar', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Senior Vice President', 'name' => 'Haji Ghulam Rasool Solangi', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Information Secretary', 'name' => 'Liaquat Ali Jamali', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Finance Secretary', 'name' => 'Tariq Hussain Memon', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                ],
            ],
            [
                'name' => 'Tehsil Mehar',
                'urdu_name' => 'تحصیل میہڑ',
                'tagline' => 'Agricultural Heart & Vibrant Grassroots Network',
                'description' => 'Mobilizing agricultural workers, youth activists and rural families across the fertile taluka of Mehar.',
                'image' => 'Assets/images/images-4.jpg',
                'members' => [
                    ['role' => 'President', 'name' => 'Sardar Ghulam Mustafa Mahisar', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'General Secretary', 'name' => 'Aijaz Ahmed Chandio', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Senior Vice President', 'name' => 'Ali Nawaz Siyal', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Information Secretary', 'name' => 'Kareem Bux Soomro', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Finance Secretary', 'name' => 'Muhammad Ramzan Khoso', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                ],
            ],
            [
                'name' => 'Tehsil Khairpur Nathan Shah',
                'urdu_name' => 'تحصیل خیرپور ناتھن شاہ',
                'tagline' => 'Resilient Leadership & People-First Public Service',
                'description' => 'Leading community rehabilitation, public health, clean water initiatives, and local party organizing throughout K.N. Shah.',
                'image' => 'Assets/images/images-2.jpg',
                'members' => [
                    ['role' => 'President', 'name' => 'Mir Ghulam Shabbir Lund', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'General Secretary', 'name' => 'Nadeem Ahmed Kalhoro', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Senior Vice President', 'name' => 'Ghulam Abbas Leghari', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Information Secretary', 'name' => 'Barkat Ali Bughio', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Finance Secretary', 'name' => 'Manzoor Hussain Chandio', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                ],
            ],
            [
                'name' => 'Tehsil Johi',
                'urdu_name' => 'تحصیل جوہی',
                'tagline' => 'Kachho Foothills & Dedicated Community Organizing',
                'description' => 'Dedicated to empowering the rural and Kachho communities, ensuring water rights, and uplifting rural families across Johi.',
                'image' => 'Assets/images/images-3.jpg',
                'members' => [
                    ['role' => 'President', 'name' => 'Mir Ahmed Khan Babar', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'General Secretary', 'name' => 'Syed Mazhar Ali Shah', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Senior Vice President', 'name' => 'Sikandar Ali Rodnani', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Information Secretary', 'name' => 'Ali Murad Rind', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                    ['role' => 'Finance Secretary', 'name' => 'Akhtar Hussain Jamali', 'phone' => '', 'image' => 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png'],
                ],
            ],
        ];
    }

    /**
     * Default statistics for tehsil bodies page.
     *
     * @return array<int, array<string, string>>
     */
    private function defaultTehsilStatistics(): array
    {
        return [
            ['value' => '4', 'label' => 'Tehsils / Talukas', 'icon' => 'fa-landmark', 'color' => 'red'],
            ['value' => '52+', 'label' => 'Union Councils', 'icon' => 'fa-people-roof', 'color' => 'green'],
            ['value' => '100+', 'label' => 'Office Bearers', 'icon' => 'fa-user-group', 'color' => 'red'],
            ['value' => '250+', 'label' => 'Ward & Village Units', 'icon' => 'fa-location-dot', 'color' => 'green'],
            ['value' => '50k+', 'label' => 'Active Workers & Supporters', 'icon' => 'fa-users', 'color' => 'red'],
        ];
    }

    /**
     * Default strategic priorities for tehsil bodies page.
     *
     * @return array<int, array<string, string>>
     */
    private function defaultTehsilPriorities(): array
    {
        return [
            ['title' => 'Grassroots Mobilization', 'description' => 'Maintaining direct contact with workers and families across every village and ward.', 'icon' => 'fa-people-group'],
            ['title' => 'Public Grievance Redressal', 'description' => 'Acting as the bridge between citizens and public administration to solve local problems.', 'icon' => 'fa-bullhorn'],
            ['title' => 'Community Development', 'description' => 'Overseeing drinking water, rural education, health facilities and public infrastructure.', 'icon' => 'fa-chart-line'],
            ['title' => 'Social Justice & Democracy', 'description' => 'Upholding Quaid-e-Awam and Shaheed Mohtarma Benazir Bhutto’s vision for equal rights and progress.', 'icon' => 'fa-scale-balanced'],
        ];
    }
}
