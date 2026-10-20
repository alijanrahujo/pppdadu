<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Leader;
use App\Models\Membership;
use App\Models\SiteSetting;
use App\Models\UnionCouncil;
use App\Models\WebsiteSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    /**
     * Show the dynamic homepage.
     */
    public function home(): View
    {
        $hero = SiteSetting::getGroup('home_hero');
        $values = SiteSetting::get('home.values', [
            ['title' => 'Serving the people', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-people-group', 'color' => 'green'],
            ['title' => 'Social justice', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-scale-balanced', 'color' => 'black'],
            ['title' => 'Democracy', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-book-open', 'color' => 'red'],
            ['title' => 'Unity & Faith', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-handshake-angle', 'color' => 'green'],
        ]);
        $profile = SiteSetting::getGroup('home_profile');
        $about = SiteSetting::getGroup('home_about');
        $join = SiteSetting::getGroup('home_join');

        $leaders = Leader::active()->slider()->get();
        if ($leaders->isEmpty()) {
            $leaders = collect([
                new Leader(['image' => 'pir-mujeeb.jpg', 'name' => 'Pir Mujeeb-ul-Haq', 'role' => 'District President']),
                new Leader(['image' => 'rashid-ali-1.jpg', 'name' => 'Syed Rashid Ali Shah', 'role' => 'Senior Vice President']),
                new Leader(['image' => 'irfanshah.jpg', 'name' => 'Syed Irfan Shah', 'role' => 'Vice President']),
                new Leader(['image' => 'naeem-bhotto.jpg', 'name' => 'Naeem Bhutto', 'role' => 'General Secretary']),
            ]);
        }
        $leadershipSlides = $leaders->chunk(4);

        $galleryFeatured = GalleryItem::featured()->get();
        if ($galleryFeatured->isEmpty()) {
            $galleryFeatured = GalleryItem::query()->take(8)->get();
        }
        $activitySlides = $galleryFeatured->isNotEmpty() ? $galleryFeatured->chunk(4) : collect();

        return view('home', compact(
            'hero',
            'values',
            'profile',
            'about',
            'join',
            'leadershipSlides',
            'activitySlides'
        ));
    }

    public function showPresident(): View
    {
        return $this->page('president');
    }

    public function showGeneralSecretary(): View
    {
        return $this->page('general-secretary');
    }

    public function showLeadership(): View
    {
        return $this->page('leadership');
    }

    public function showDistrictBody(): View
    {
        return $this->page('district-body');
    }

    public function showTehsilBodies(): View
    {
        return $this->page('tehsil-bodies');
    }

    public function showMunicipalBodies(): View
    {
        return $this->page('municipal-bodies');
    }

    public function showUnionCouncilBodies(): View
    {
        return $this->page('union-council-bodies');
    }

    public function showMediaGallery(): View
    {
        return $this->page('media-gallery');
    }

    public function showMembers(): View
    {
        return $this->page('members-area');
    }

    public function showMembership(): View
    {
        return $this->page('join');
    }

    public function showContact(): View
    {
        return $this->page('contact');
    }

    public function storeMembership(Request $request): RedirectResponse
    {
        // Normalization for legacy submissions / tests
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

        WebsiteSubmission::query()->create([
            'submission_type' => 'membership',
            'status' => 'new',
            'is_read' => false,
            'payload' => $data,
        ]);

        return back()->with('status', 'Your membership application has been received.');
    }

    public function storeContact(Request $request): RedirectResponse
    {
        return $this->storeSubmission(
            $request,
            'contact',
            [
                'full_name' => ['required', 'string', 'max:150'],
                'cnic_number' => ['required', 'string', 'regex:/^\d{5}-?\d{7}-?\d$/'],
                'email_address' => ['nullable', 'email', 'max:255'],
                'phone_number' => ['nullable', 'string', 'max:30'],
                'contact_type' => ['required', 'in:Suggestion,Complaint,General inquiry'],
                'message' => ['required', 'string', 'max:5000'],
            ],
            'Your message has been received.',
        );
    }

    private function page(string $slug): View
    {
        $page = [];

        if ($slug === 'president') {
            $s = SiteSetting::getGroup('page_president');
            $page = [
                'type' => 'profile',
                'layout' => 'president',
                'title' => $s['president.title'] ?? 'About Our President',
                'eyebrow' => $s['president.eyebrow'] ?? 'District leadership',
                'subtitle' => $s['president.name'] ?? 'Barrister Pir Mujeeb-ul-Haq',
                'image' => $s['president.image'] ?? 'mujeepir-1024x1024.png',
                'image_alt' => $s['president.name'] ?? 'Barrister Pir Mujeeb-ul-Haq',
                'role' => $s['president.role'] ?? 'MPA and District President, Pakistan Peoples Party District Dadu',
                'description' => $s['president.description'] ?? 'Barrister Pir Mujeeb-ul-Haq is the District President of Pakistan Peoples Party District Dadu...',
                'principles' => $s['president.principles'] ?? ["Advocate for People's Rights", 'Development Focused', 'Democracy & Justice', 'Community First'],
                'quote' => $s['president.quote'] ?? 'Leadership is not about power, it is about responsibility and service to people.',
                'statement' => $s['president.statement'] ?? "<p>“My mission is to serve the people of Dadu with honesty, transparency and dedication, and to build a stronger, progressive and united society.”</p>\n<cite>- Barrister Pir Mujeeb-ul-Haq</cite>\n<span>President, PPP District Dadu</span>",
                'mission' => $s['president.mission'] ?? 'To serve the people of Dadu with honesty, transparency and dedication...',
                'vision' => $s['president.vision'] ?? 'A democratic, peaceful and prosperous Dadu where every citizen has equal opportunities...',
                'achievements' => $s['president.achievements'] ?? [],
                'journey' => $s['president.journey'] ?? [],
            ];
        } elseif ($slug === 'general-secretary') {
            $s = SiteSetting::getGroup('page_general_secretary');
            $page = [
                'type' => 'profile',
                'layout' => 'general-secretary',
                'title' => $s['general_secretary.title'] ?? 'About Our General Secretary',
                'eyebrow' => $s['general_secretary.eyebrow'] ?? 'District leadership',
                'subtitle' => $s['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah',
                'image' => $s['general_secretary.image'] ?? 'gc-1024x1024.png',
                'image_alt' => $s['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah',
                'role' => $s['general_secretary.role'] ?? 'General Secretary, Pakistan Peoples Party District Dadu',
                'description' => $s['general_secretary.description'] ?? '<p>Syed Naveed Ahmed Shah is a committed party leader and an energetic organizer who works day and night for the strengthening of PPP in District Dadu.</p><p>He believes in teamwork, dedication and discipline and is focused on bringing the party vision to every corner of the district.</p>',
                'principles' => $s['general_secretary.principles'] ?? ['Strong Leadership', 'Party Organization', 'Public Service', 'Youth Empowerment'],
                'quote' => $s['general_secretary.quote'] ?? 'Our strength lies in our unity and our connection with the people. Together, we can build a stronger, progressive and prosperous Dadu.',
                'statement' => $s['general_secretary.statement'] ?? ('<p>“'.($s['general_secretary.quote'] ?? 'Our strength lies in our unity and our connection with the people. Together, we can build a stronger, progressive and prosperous Dadu.')."”</p>\n<cite>- ".($s['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah')."</cite>\n<span>".($s['general_secretary.role'] ?? 'General Secretary, PPP District Dadu').'</span>'),
                'commitments' => $s['general_secretary.commitments'] ?? [],
            ];
        } elseif ($slug === 'district-body') {
            $s = SiteSetting::getGroup('page_district_body');
            $membersList = Leader::active()->districtBody()->get();
            $members = [];
            foreach ($membersList as $m) {
                $members[] = [
                    'name' => $m->name,
                    'role' => $m->role,
                    'image_url' => $m->image_url,
                    'link' => $m->link,
                ];
            }
            if (empty($members)) {
                $members = [
                    ['name' => 'Barrister Pir Mujeeb-ul-Haq', 'role' => 'District President', 'image_url' => asset('Assets/images/mujeepir-1024x1024.png'), 'link' => route('pages.president')],
                    ['name' => 'Syed Naveed Ahmed Shah', 'role' => 'General Secretary', 'image_url' => asset('Assets/images/gc-1024x1024.png'), 'link' => route('pages.general-secretary')],
                ];
            }

            $page = [
                'type' => 'directory',
                'layout' => 'district-body',
                'title' => $s['district_body.title'] ?? 'District Body',
                'eyebrow' => $s['district_body.eyebrow'] ?? 'Party organization',
                'subtitle' => $s['district_body.subtitle'] ?? 'District Body',
                'description' => $s['district_body.description'] ?? 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu.',
                'members' => $members,
                'principles' => $s['district_body.principles'] ?? [],
            ];
        } elseif ($slug === 'leadership') {
            $s = SiteSetting::getGroup('page_leadership');
            $leadersList = Leader::active()->get();
            $members = [];
            foreach ($leadersList as $m) {
                $members[] = [
                    'name' => $m->name,
                    'role' => $m->role,
                    'district' => $m->district ?: 'District Dadu',
                    'image_url' => $m->image_url,
                    'link' => $m->link,
                ];
            }
            if (empty($members)) {
                $members = [
                    ['name' => 'Shaheed Zulfikar Ali Bhutto', 'role' => 'Founder & Quaid-e-Awam', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/1-1024x1024.png'), 'link' => null],
                    ['name' => 'Shaheed Mohtarma Benazir Bhutto', 'role' => 'Shaheed-e-Jamhooriat', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/2-1024x1024.png'), 'link' => null],
                    ['name' => 'President Asif Ali Zardari', 'role' => 'President of Pakistan', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/3-1024x1024.png'), 'link' => null],
                    ['name' => 'Chairman Bilawal Bhutto Zardari', 'role' => 'Chairman, Pakistan Peoples Party', 'district' => 'Pakistan Peoples Party', 'image_url' => asset('Assets/images/4-1024x1024.png'), 'link' => null],
                    ['name' => 'Barrister Pir Mujeeb-ul-Haq', 'role' => 'District President', 'district' => 'District Dadu', 'image_url' => asset('Assets/images/mujeepir-1024x1024.png'), 'link' => route('pages.president')],
                    ['name' => 'Syed Naveed Ahmed Shah', 'role' => 'General Secretary', 'district' => 'District Dadu', 'image_url' => asset('Assets/images/gc-1024x1024.png'), 'link' => route('pages.general-secretary')],
                ];
            }

            $page = [
                'type' => 'directory',
                'layout' => 'leadership',
                'title' => $s['leadership.title'] ?? 'Our Leadership',
                'eyebrow' => $s['leadership.eyebrow'] ?? 'Party Leadership',
                'subtitle' => $s['leadership.subtitle'] ?? 'Our Leadership',
                'description' => $s['leadership.description'] ?? 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu under our inspiring leadership.',
                'members' => $members,
                'principles' => $s['leadership.principles'] ?? [
                    ['title' => 'Democracy & Equality', 'description' => 'Unshakable faith in democratic values, constitutional rule and equal rights for all citizens.', 'icon' => 'fa-landmark'],
                    ['title' => 'Public Service', 'description' => 'Dedicated to uplifting vulnerable citizens, rural communities and laborers across District Dadu.', 'icon' => 'fa-people-roof'],
                    ['title' => 'Social Justice', 'description' => 'Eliminating disparity, safeguarding human rights, and expanding healthcare and education access.', 'icon' => 'fa-scale-balanced'],
                    ['title' => 'Youth & Women Empowerment', 'description' => 'Providing progressive platforms and leadership roles for young activists and women in political life.', 'icon' => 'fa-handshake-angle'],
                ],
            ];
        } elseif (in_array($slug, ['tehsil-bodies', 'tahseel-bodies', 'taseel-bodies'], true)) {
            $s = SiteSetting::getGroup('page_tehsil_bodies');
            $defaultTehsils = [
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

            $defaultStats = [
                ['value' => '4', 'label' => 'Tehsils / Talukas', 'icon' => 'fa-landmark', 'color' => 'red'],
                ['value' => '52+', 'label' => 'Union Councils', 'icon' => 'fa-people-roof', 'color' => 'green'],
                ['value' => '100+', 'label' => 'Office Bearers', 'icon' => 'fa-user-group', 'color' => 'red'],
                ['value' => '250+', 'label' => 'Ward & Village Units', 'icon' => 'fa-location-dot', 'color' => 'green'],
                ['value' => '50k+', 'label' => 'Active Workers & Supporters', 'icon' => 'fa-users', 'color' => 'red'],
            ];

            $defaultPriorities = [
                ['title' => 'Grassroots Mobilization', 'description' => 'Maintaining direct contact with workers and families across every village and ward.', 'icon' => 'fa-people-group'],
                ['title' => 'Public Grievance Redressal', 'description' => 'Acting as the bridge between citizens and public administration to solve local problems.', 'icon' => 'fa-bullhorn'],
                ['title' => 'Community Development', 'description' => 'Overseeing drinking water, rural education, health facilities and public infrastructure.', 'icon' => 'fa-chart-line'],
                ['title' => 'Social Justice & Democracy', 'description' => 'Upholding Quaid-e-Awam and Shaheed Mohtarma Benazir Bhutto’s vision for equal rights and progress.', 'icon' => 'fa-scale-balanced'],
            ];

            $page = [
                'type' => 'organization',
                'layout' => 'tehsil-bodies',
                'title' => $s['tehsil_bodies.title'] ?? 'Tehsil Bodies',
                'eyebrow' => $s['tehsil_bodies.eyebrow'] ?? 'Grassroots Organization',
                'subtitle' => $s['tehsil_bodies.subtitle'] ?? 'Working for the People across All 4 Tehsils of District Dadu',
                'description' => $s['tehsil_bodies.description'] ?? '<p>Pakistan Peoples Party has a robust grassroots organizational network spread across all four tehsils of District Dadu: <strong>Dadu</strong>, <strong>Mehar</strong>, <strong>Khairpur Nathan Shah</strong>, and <strong>Johi</strong>.</p><p>Our dedicated Tehsil office bearers work relentlessly to mobilize party workers, address local community issues, and implement the progressive vision of our leadership at the town and village level.</p>',
                'statistics' => $s['tehsil_bodies.statistics'] ?? $defaultStats,
                'tehsils' => $s['tehsil_bodies.tehsils'] ?? $defaultTehsils,
                'priorities' => $s['tehsil_bodies.priorities'] ?? $defaultPriorities,
            ];
        } elseif ($slug === 'municipal-bodies') {
            $s = SiteSetting::getGroup('page_municipal_bodies');
            $page = [
                'type' => 'municipal',
                'layout' => 'municipal-bodies',
                'title' => $s['municipal_bodies.title'] ?? 'Municipal & Town Bodies',
                'eyebrow' => $s['municipal_bodies.eyebrow'] ?? 'Local organization',
                'subtitle' => $s['municipal_bodies.subtitle'] ?? 'Working for stronger communities',
                'description' => $s['municipal_bodies.description'] ?? 'Municipal and town bodies play a vital role...',
                'statistics' => $s['municipal_bodies.statistics'] ?? [],
                'priorities' => $s['municipal_bodies.priorities'] ?? [],
            ];
        } elseif ($slug === 'union-council-bodies') {
            $s = SiteSetting::getGroup('page_union_councils');
            $councils = UnionCouncil::query()->orderBy('order')->orderBy('id')->get()->toArray();

            $page = [
                'type' => 'councils',
                'layout' => 'union-councils',
                'title' => $s['union_councils.title'] ?? 'Union Council Bodies & Members',
                'eyebrow' => $s['union_councils.eyebrow'] ?? 'Grassroots organization',
                'subtitle' => $s['union_councils.subtitle'] ?? 'Our Union Councils are the strength of our organization...',
                'councils' => $councils,
                'statistics' => SiteSetting::get('municipal_bodies.statistics', []),
            ];
        } elseif ($slug === 'media-gallery') {
            $items = GalleryItem::query()->orderBy('order')->orderByDesc('id')->get();
            $images = [];
            foreach ($items as $item) {
                $images[] = [
                    'file' => $item->image,
                    'alt' => $item->alt ?? $item->title ?? 'Activity photo',
                    'title' => $item->title ?? '',
                    'category' => $item->category,
                ];
            }

            $page = [
                'type' => 'gallery',
                'layout' => 'media-gallery',
                'title' => 'Media Gallery',
                'eyebrow' => 'Our activities',
                'subtitle' => 'Moments from our activities',
                'images' => $images,
            ];
        } elseif ($slug === 'members-area' || $slug === 'members') {
            $s = SiteSetting::getGroup('page_members_area');
            $request = request();
            $search = $request->query('search');
            $wing = $request->query('wing');
            $city = $request->query('city');

            $query = Membership::query()->latest();

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
                'total' => Membership::count(),
                'primary' => Membership::where('member_type', 'Primary Member')->count(),
                'youth' => Membership::where('member_type', 'Youth Wing')->count(),
                'women' => Membership::where('member_type', 'Women Wing')->count(),
            ];

            $page = [
                'type' => 'members',
                'layout' => 'members',
                'title' => $s['members.title'] ?? 'Members Area',
                'eyebrow' => $s['members.eyebrow'] ?? 'Our Strength',
                'subtitle' => $s['members.subtitle'] ?? 'Registered members and volunteers of Pakistan Peoples Party District Dadu.',
                'members' => $members,
                'stats' => $stats,
                'search' => $search,
                'wing' => $wing,
                'city' => $city,
            ];
        } elseif ($slug === 'join') {
            $s = SiteSetting::getGroup('page_join');
            $page = [
                'type' => 'membership',
                'layout' => 'membership',
                'title' => $s['join.title'] ?? 'Join (Online Membership)',
                'eyebrow' => $s['join.eyebrow'] ?? 'Be a part of change',
                'subtitle' => $s['join.subtitle'] ?? 'Become a part of Pakistan Peoples Party District Dadu...',
                'principles' => $s['join.principles'] ?? [],
            ];
        } elseif ($slug === 'contact') {
            $s = SiteSetting::getGroup('page_contact');
            $page = [
                'type' => 'contact',
                'layout' => 'contact',
                'title' => $s['contact.title'] ?? 'Suggestions / Complaints / Contacts',
                'eyebrow' => $s['contact.eyebrow'] ?? 'We are listening',
                'subtitle' => $s['contact.subtitle'] ?? 'Have a suggestion or concern to share? Send a message...',
                'principles' => $s['contact.principles'] ?? [],
            ];
        }

        abort_if(empty($page), 404);

        return view('pages.show', ['page' => $page]);
    }

    /**
     * Validate without flashing sensitive form fields back into the session.
     *
     * @param  array<string, array<int, string>>  $rules
     */
    private function storeSubmission(
        Request $request,
        string $type,
        array $rules,
        string $successMessage,
    ): RedirectResponse {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = $validator->validated();

        if (isset($data['cnic_number'])) {
            $data['cnic_number'] = str_replace('-', '', $data['cnic_number']);
        }

        WebsiteSubmission::query()->create([
            'submission_type' => $type,
            'status' => 'new',
            'is_read' => false,
            'payload' => $data,
        ]);

        return back()->with('status', $successMessage);
    }
}
