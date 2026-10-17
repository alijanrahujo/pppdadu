<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\Leader;
use App\Models\SiteSetting;
use App\Models\UnionCouncil;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WebsiteContentSeeder extends Seeder
{
    /**
     * Seed the website content.
     */
    public function run(): void
    {
        // 1. Create or update Default Admin User
        User::query()->updateOrCreate(
            ['email' => 'admin@pppdadu.com'],
            [
                'name' => 'PPP District Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Site General Settings
        $settings = [
            // General
            ['key' => 'site.title', 'value' => 'Pakistan Peoples Party | District Dadu', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.name', 'value' => 'Pakistan Peoples Party', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.district', 'value' => 'District Dadu', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.tagline', 'value' => 'Committed to democracy, social justice and the welfare of the people.', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.phone', 'value' => '+92 300 1234567', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.email', 'value' => 'info@pppdadu.com', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.address', 'value' => 'District Office Pakistan Peoples Party, Dadu, Sindh, Pakistan', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site.facebook', 'value' => 'https://facebook.com', 'group' => 'social', 'type' => 'text'],
            ['key' => 'site.twitter', 'value' => 'https://x.com', 'group' => 'social', 'type' => 'text'],
            ['key' => 'site.youtube', 'value' => 'https://youtube.com', 'group' => 'social', 'type' => 'text'],

            // Home Hero
            ['key' => 'home.hero.title', 'value' => 'Pakistan Peoples Party', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.district', 'value' => 'District Dadu', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.subtitle', 'value' => 'Committed to Democracy, Social Justice and welfare of the people', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.btn_primary_text', 'value' => 'Learn More', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.btn_primary_url', 'value' => '/about/president', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.btn_outline_text', 'value' => 'Our Vision', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.btn_outline_url', 'value' => '#about', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.video', 'value' => 'Assets/video/hero-section-bg.mp4', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.poster', 'value' => 'Assets/images/Mass-Rally-Beneath-a-Crescent-Flag.jpg', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.leader_left', 'value' => 'Assets/images/Respectful-Greeting-in-Charcoal-Kurta-1.png', 'group' => 'home_hero', 'type' => 'text'],
            ['key' => 'home.hero.leader_right', 'value' => 'Assets/images/Businessman-Explaining-with-Expressive-Hand-Gestures-1.png', 'group' => 'home_hero', 'type' => 'text'],

            // Home Values Strip
            ['key' => 'home.values', 'value' => json_encode([
                ['title' => 'Serving the people', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-people-group', 'color' => 'green'],
                ['title' => 'Social justice', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-scale-balanced', 'color' => 'black'],
                ['title' => 'Democracy', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-book-open', 'color' => 'red'],
                ['title' => 'Unity & Faith', 'subtitle' => 'Working for a better tomorrow for all.', 'icon' => 'fa-handshake-angle', 'color' => 'green'],
            ]), 'group' => 'home_values', 'type' => 'json'],

            // Home Profile (Deputy Information Secretary)
            ['key' => 'home.profile.name', 'value' => 'Sajad Ahmed Junejo', 'group' => 'home_profile', 'type' => 'text'],
            ['key' => 'home.profile.role', 'value' => 'Website Operator | Deputy Information Secretary, Pakistan Peoples Party, District Dadu (Sindh)', 'group' => 'home_profile', 'type' => 'text'],
            ['key' => 'home.profile.image', 'value' => 'Assets/images/Professional-Portrait-Cutout-on-Transparency.png', 'group' => 'home_profile', 'type' => 'text'],
            ['key' => 'home.profile.bio1', 'value' => 'Sajad Ahmed Junejo is associated with the Pakistan Peoples Party (PPP) as the Deputy Information Secretary for District Dadu, Sindh. In his role, he contributes to party communication, information sharing, and public engagement. As a website operator, he is involved in managing website content and supporting the presentation of information through digital platforms.', 'group' => 'home_profile', 'type' => 'textarea'],
            ['key' => 'home.profile.bio2', 'value' => 'His professional and political roles reflect an involvement in digital communication, information management, and organizational activities. Through these responsibilities, he aims to support effective communication, improve access to information, and maintain a strong connection with the public.', 'group' => 'home_profile', 'type' => 'textarea'],

            // Home About Section
            ['key' => 'home.about.eyebrow', 'value' => 'About PPP District Dadu', 'group' => 'home_about', 'type' => 'text'],
            ['key' => 'home.about.title', 'value' => 'A Strong Voice for the people of Dadu', 'group' => 'home_about', 'type' => 'text'],
            ['key' => 'home.about.description', 'value' => 'Pakistan Peoples Party District Dadu is committed to democracy, social justice and the welfare of the people. We work with our communities to support equal opportunity, local development and a more prosperous future for every citizen.', 'group' => 'home_about', 'type' => 'textarea'],
            ['key' => 'home.about.principles', 'value' => json_encode(['Democracy', 'Development', 'Social Justice', "People's Empowerment"]), 'group' => 'home_about', 'type' => 'json'],
            ['key' => 'home.about.image', 'value' => 'Assets/images/ppp2-1024x568.jpg', 'group' => 'home_about', 'type' => 'text'],
            ['key' => 'home.about.stats', 'value' => json_encode([
                ['value' => '25+', 'label' => 'Years of service'],
                ['value' => '14', 'label' => 'Town Committees'],
                ['value' => '50+', 'label' => 'Union Councils'],
                ['value' => '100k+', 'label' => 'Party Members'],
            ]), 'group' => 'home_about', 'type' => 'json'],

            // Home Join Section
            ['key' => 'home.join.title', 'value' => 'Join Hands For a Better Future', 'group' => 'home_join', 'type' => 'text'],
            ['key' => 'home.join.description', 'value' => 'Become a part of Pakistan Peoples Party District Dadu and contribute to the progress, peace and prosperity of our society.', 'group' => 'home_join', 'type' => 'textarea'],
            ['key' => 'home.join.btn_primary_text', 'value' => 'Learn More', 'group' => 'home_join', 'type' => 'text'],
            ['key' => 'home.join.btn_primary_url', 'value' => '/join', 'group' => 'home_join', 'type' => 'text'],
            ['key' => 'home.join.btn_outline_text', 'value' => 'Our Vision', 'group' => 'home_join', 'type' => 'text'],
            ['key' => 'home.join.btn_outline_url', 'value' => '#about', 'group' => 'home_join', 'type' => 'text'],

            // President Page
            ['key' => 'president.title', 'value' => 'About Our President', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.eyebrow', 'value' => 'District leadership', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.name', 'value' => 'Barrister Pir Mujeeb-ul-Haq', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.role', 'value' => 'MPA and District President, Pakistan Peoples Party District Dadu', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.image', 'value' => 'Assets/images/mujeepir-1024x1024.png', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.description', 'value' => 'Barrister Pir Mujeeb-ul-Haq is the District President of Pakistan Peoples Party District Dadu and a member of the Provincial Assembly. His leadership page reflects the party’s focus on people’s rights, development and public service.', 'group' => 'page_president', 'type' => 'textarea'],
            ['key' => 'president.quote', 'value' => 'Leadership is not about power, it is about responsibility and service to people.', 'group' => 'page_president', 'type' => 'text'],
            ['key' => 'president.mission', 'value' => 'To serve the people of Dadu with honesty, transparency and dedication, and to build a stronger, progressive and united society.', 'group' => 'page_president', 'type' => 'textarea'],
            ['key' => 'president.vision', 'value' => 'A democratic, peaceful and prosperous Dadu where every citizen has equal opportunities to grow and succeed.', 'group' => 'page_president', 'type' => 'textarea'],
            ['key' => 'president.principles', 'value' => json_encode(["Advocate for People's Rights", 'Development Focused', 'Democracy & Justice', 'Community First']), 'group' => 'page_president', 'type' => 'json'],
            ['key' => 'president.achievements', 'value' => json_encode([
                ['title' => 'Infrastructure Development', 'description' => 'Working for better roads, bridges and public facilities in Dadu.', 'icon' => 'fa-road'],
                ['title' => 'Education Promotion', 'description' => 'Supporting quality education and creating opportunities for youth.', 'icon' => 'fa-book-open'],
                ['title' => 'Healthcare Initiatives', 'description' => 'Promoting healthcare facilities and awareness for a healthier community.', 'icon' => 'fa-heart-pulse'],
                ['title' => 'Youth Empowerment', 'description' => 'Encouraging youth leadership and skill development programs.', 'icon' => 'fa-people-group'],
                ['title' => 'Social Welfare Programs', 'description' => 'Standing with the underprivileged and supporting social justice.', 'icon' => 'fa-hand-holding-heart'],
            ]), 'group' => 'page_president', 'type' => 'json'],
            ['key' => 'president.journey', 'value' => json_encode([
                ['period' => '1995–2005', 'description' => 'Started a public service journey advocating for people’s rights.'],
                ['period' => '2005–2010', 'description' => 'Elected as an MPA and continued working for progress.'],
                ['period' => '2010–2015', 'description' => 'Strengthened party organization and expanded public welfare initiatives.'],
                ['period' => '2015–2020', 'description' => 'Focused on infrastructure, education and youth empowerment.'],
                ['period' => '2020–Present', 'description' => 'Continues working toward a progressive future for District Dadu.'],
            ]), 'group' => 'page_president', 'type' => 'json'],

            // General Secretary Page
            ['key' => 'general_secretary.title', 'value' => 'About Our General Secretary', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.eyebrow', 'value' => 'District leadership', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.name', 'value' => 'Syed Naveed Ahmed Shah', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.role', 'value' => 'General Secretary, Pakistan Peoples Party District Dadu', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.image', 'value' => 'Assets/images/gc-1024x1024.png', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.description', 'value' => 'Syed Naveed Ahmed Shah is a committed party leader and an energetic organizer who works day and night for the strengthening of PPP in District Dadu. He believes in teamwork, dedication and discipline and is focused on bringing the party vision to every corner of the district.', 'group' => 'page_general_secretary', 'type' => 'textarea'],
            ['key' => 'general_secretary.quote', 'value' => 'Our strength lies in our unity and our connection with the people. Together, we can build a stronger, progressive and prosperous Dadu.', 'group' => 'page_general_secretary', 'type' => 'text'],
            ['key' => 'general_secretary.principles', 'value' => json_encode(['Strong Leadership', 'Party Organization', 'Public Service', 'Youth Empowerment']), 'group' => 'page_general_secretary', 'type' => 'json'],
            ['key' => 'general_secretary.commitments', 'value' => json_encode([
                ['title' => 'People First', 'description' => 'Putting the people’s needs at the forefront of decisions and actions.', 'icon' => 'fa-people-group'],
                ['title' => 'Transparency', 'description' => 'Promoting transparency and accountability in every responsibility.', 'icon' => 'fa-scale-balanced'],
                ['title' => 'Social Justice', 'description' => 'Striving for equality, justice and the rights of every individual.', 'icon' => 'fa-handshake-angle'],
                ['title' => 'Development', 'description' => 'Working for balanced development and progress in every area.', 'icon' => 'fa-chart-line'],
                ['title' => 'Party Commitment', 'description' => 'Loyal to the ideology of PPP and committed to its mission.', 'icon' => 'fa-flag'],
            ]), 'group' => 'page_general_secretary', 'type' => 'json'],

            // District Body Page
            ['key' => 'district_body.title', 'value' => 'District Body', 'group' => 'page_district_body', 'type' => 'text'],
            ['key' => 'district_body.eyebrow', 'value' => 'Party organization', 'group' => 'page_district_body', 'type' => 'text'],
            ['key' => 'district_body.subtitle', 'value' => 'District Body', 'group' => 'page_district_body', 'type' => 'text'],
            ['key' => 'district_body.description', 'value' => 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu.', 'group' => 'page_district_body', 'type' => 'textarea'],
            ['key' => 'district_body.principles', 'value' => json_encode([
                ['title' => 'Strong Leadership', 'description' => 'Leading with vision, integrity and dedication for the people.', 'icon' => 'fa-user-tie'],
                ['title' => 'Party Organization', 'description' => 'Strengthening the party structure across the district.', 'icon' => 'fa-sitemap'],
                ['title' => 'Public Service', 'description' => 'Ready to address public concerns and community issues.', 'icon' => 'fa-hand-holding-heart'],
                ['title' => 'Youth Empowerment', 'description' => 'Supporting political awareness and youth participation.', 'icon' => 'fa-people-group'],
                ['title' => 'Unity & Democracy', 'description' => 'Promoting unity, democracy and social justice.', 'icon' => 'fa-scale-balanced'],
            ]), 'group' => 'page_district_body', 'type' => 'json'],

            // Municipal & Town Bodies Page
            ['key' => 'municipal_bodies.title', 'value' => 'Municipal & Town Bodies', 'group' => 'page_municipal_bodies', 'type' => 'text'],
            ['key' => 'municipal_bodies.eyebrow', 'value' => 'Local organization', 'group' => 'page_municipal_bodies', 'type' => 'text'],
            ['key' => 'municipal_bodies.subtitle', 'value' => 'Working for stronger communities', 'group' => 'page_municipal_bodies', 'type' => 'text'],
            ['key' => 'municipal_bodies.description', 'value' => 'Municipal and town bodies play a vital role in building a better, cleaner and more developed District Dadu. Together, local representatives can support better governance, local development, community support and public welfare.', 'group' => 'page_municipal_bodies', 'type' => 'textarea'],
            ['key' => 'municipal_bodies.statistics', 'value' => json_encode([
                ['value' => '4', 'label' => 'Municipal Committees', 'icon' => 'fa-landmark', 'color' => 'red'],
                ['value' => '6', 'label' => 'Town Committees', 'icon' => 'fa-landmark', 'color' => 'green'],
                ['value' => '50+', 'label' => 'Elected Members', 'icon' => 'fa-people-group', 'color' => 'red'],
                ['value' => '100+', 'label' => 'Local Projects', 'icon' => 'fa-location-dot', 'color' => 'green'],
                ['value' => '10k+', 'label' => 'People Served', 'icon' => 'fa-people-group', 'color' => 'red'],
            ]), 'group' => 'page_municipal_bodies', 'type' => 'json'],
            ['key' => 'municipal_bodies.priorities', 'value' => json_encode([
                ['title' => 'Better Governance', 'description' => 'Responsive local bodies that listen and serve.', 'icon' => 'fa-landmark'],
                ['title' => 'Local Development', 'description' => 'Supporting cleaner and more accessible communities.', 'icon' => 'fa-road'],
                ['title' => 'Community Support', 'description' => 'Keeping local needs at the center of public service.', 'icon' => 'fa-people-group'],
                ['title' => 'Public Welfare', 'description' => 'Working for the wellbeing of people across the district.', 'icon' => 'fa-hand-holding-heart'],
            ]), 'group' => 'page_municipal_bodies', 'type' => 'json'],

            // Union Councils Page
            ['key' => 'union_councils.title', 'value' => 'Union Council Bodies & Members', 'group' => 'page_union_councils', 'type' => 'text'],
            ['key' => 'union_councils.eyebrow', 'value' => 'Grassroots organization', 'group' => 'page_union_councils', 'type' => 'text'],
            ['key' => 'union_councils.subtitle', 'value' => 'Our Union Councils are the strength of our organization at the grassroots level. Meet the dedicated office bearers and members working for the people of District Dadu.', 'group' => 'page_union_councils', 'type' => 'textarea'],

            // Join Page
            ['key' => 'join.title', 'value' => 'Join (Online Membership)', 'group' => 'page_join', 'type' => 'text'],
            ['key' => 'join.eyebrow', 'value' => 'Be a part of change', 'group' => 'page_join', 'type' => 'text'],
            ['key' => 'join.subtitle', 'value' => 'Become a part of Pakistan Peoples Party District Dadu and contribute to the progress, peace and prosperity of our society.', 'group' => 'page_join', 'type' => 'textarea'],
            ['key' => 'join.principles', 'value' => json_encode([
                ['title' => 'Be a Part of Change', 'description' => 'Join a legacy of leadership and democracy.', 'icon' => 'fa-people-group'],
                ['title' => 'Raise Your Voice', 'description' => 'Share your views and shape a better tomorrow.', 'icon' => 'fa-bullhorn'],
                ['title' => 'Work for the People', 'description' => 'Serve your community and stand for social justice.', 'icon' => 'fa-handshake-angle'],
                ['title' => 'Build a Stronger Future', 'description' => 'Work together for a peaceful, prosperous and progressive Pakistan.', 'icon' => 'fa-arrow-trend-up'],
                ['title' => 'Official Membership Card', 'description' => 'Get your official party membership card after approval.', 'icon' => 'fa-address-card'],
            ]), 'group' => 'page_join', 'type' => 'json'],

            // Contact Page
            ['key' => 'contact.title', 'value' => 'Suggestions / Complaints / Contacts', 'group' => 'page_contact', 'type' => 'text'],
            ['key' => 'contact.eyebrow', 'value' => 'We are listening', 'group' => 'page_contact', 'type' => 'text'],
            ['key' => 'contact.subtitle', 'value' => 'Have a suggestion or concern to share? Send a message to Pakistan Peoples Party District Dadu.', 'group' => 'page_contact', 'type' => 'textarea'],
            ['key' => 'contact.principles', 'value' => json_encode([
                ['title' => 'Your Voice Matters', 'description' => 'Every suggestion helps us improve and serve you better.', 'icon' => 'fa-people-group'],
                ['title' => 'Quick Response', 'description' => 'We review every message and work to respond promptly.', 'icon' => 'fa-people-group'],
                ['title' => 'Better Tomorrow', 'description' => 'Together, we can build a peaceful, progressive and prosperous District Dadu.', 'icon' => 'fa-people-group'],
            ]), 'group' => 'page_contact', 'type' => 'json'],

            // Leadership Page
            ['key' => 'leadership.title', 'value' => 'Our Leadership', 'group' => 'page_leadership', 'type' => 'text'],
            ['key' => 'leadership.eyebrow', 'value' => 'Party Leadership', 'group' => 'page_leadership', 'type' => 'text'],
            ['key' => 'leadership.subtitle', 'value' => 'Our Leadership', 'group' => 'page_leadership', 'type' => 'text'],
            ['key' => 'leadership.description', 'value' => 'We are committed to serve the people and work for the development, rights and prosperity of District Dadu under our inspiring leadership.', 'group' => 'page_leadership', 'type' => 'textarea'],
            ['key' => 'leadership.principles', 'value' => json_encode([
                ['title' => 'Democracy & Equality', 'description' => 'Unshakable faith in democratic values, constitutional rule and equal rights for all citizens.', 'icon' => 'fa-landmark'],
                ['title' => 'Public Service', 'description' => 'Dedicated to uplifting vulnerable citizens, rural communities and laborers across District Dadu.', 'icon' => 'fa-people-roof'],
                ['title' => 'Social Justice', 'description' => 'Eliminating disparity, safeguarding human rights, and expanding healthcare and education access.', 'icon' => 'fa-scale-balanced'],
                ['title' => 'Youth & Women Empowerment', 'description' => 'Providing progressive platforms and leadership roles for young activists and women in political life.', 'icon' => 'fa-handshake-angle'],
            ]), 'group' => 'page_leadership', 'type' => 'json'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'group' => $setting['group'],
                    'type' => $setting['type'],
                ]
            );
        }

        // 3. Central Party Leadership
        $centralLeaders = [
            ['name' => 'Shaheed Zulfikar Ali Bhutto', 'role' => 'Founder & Quaid-e-Awam', 'district' => 'Pakistan Peoples Party', 'image' => '1-1024x1024.png', 'link' => null, 'order' => 1],
            ['name' => 'Shaheed Mohtarma Benazir Bhutto', 'role' => 'Shaheed-e-Jamhooriat', 'district' => 'Pakistan Peoples Party', 'image' => '2-1024x1024.png', 'link' => null, 'order' => 2],
            ['name' => 'President Asif Ali Zardari', 'role' => 'President of Pakistan', 'district' => 'Pakistan Peoples Party', 'image' => '3-1024x1024.png', 'link' => null, 'order' => 3],
            ['name' => 'Chairman Bilawal Bhutto Zardari', 'role' => 'Chairman, Pakistan Peoples Party', 'district' => 'Pakistan Peoples Party', 'image' => '4-1024x1024.png', 'link' => null, 'order' => 4],
        ];

        foreach ($centralLeaders as $leader) {
            Leader::query()->updateOrCreate(
                ['name' => $leader['name'], 'category' => 'central_leadership'],
                array_merge($leader, ['category' => 'central_leadership', 'is_active' => true])
            );
        }

        // 4. Home Leadership Slider Leaders
        $sliderLeaders = [
            ['name' => 'Pir Mujeeb-ul-Haq', 'role' => 'District President', 'district' => 'District Dadu', 'image' => 'pir-mujeeb.jpg', 'link' => '/about/president', 'order' => 1],
            ['name' => 'Syed Rashid Ali Shah', 'role' => 'Senior Vice President', 'district' => 'District Dadu', 'image' => 'rashid-ali-1.jpg', 'link' => '/about/president', 'order' => 2],
            ['name' => 'Syed Irfan Shah', 'role' => 'Vice President', 'district' => 'District Dadu', 'image' => 'irfanshah.jpg', 'link' => '/about/president', 'order' => 3],
            ['name' => 'Naeem Bhutto', 'role' => 'General Secretary', 'district' => 'District Dadu', 'image' => 'naeem-bhotto.jpg', 'link' => '/about/general-secretary', 'order' => 4],
        ];

        foreach ($sliderLeaders as $leader) {
            Leader::query()->updateOrCreate(
                ['name' => $leader['name'], 'category' => 'leadership_slider'],
                array_merge($leader, ['is_active' => true])
            );
        }

        // 5. District Body Members
        $districtBodyMembers = [
            ['name' => 'Barrister Pir Mujeeb-ul-Haq', 'role' => 'District President', 'image' => 'mujeepir-1024x1024.png', 'link' => '/about/president', 'order' => 1],
            ['name' => 'Syed Naveed Ahmed Shah', 'role' => 'General Secretary', 'image' => 'gc-1024x1024.png', 'link' => '/about/general-secretary', 'order' => 2],
            ['name' => 'Haji Abdul Rehman', 'role' => 'Senior Vice President', 'image' => null, 'link' => null, 'order' => 3],
            ['name' => 'Mir Hassan Bux Talpur', 'role' => 'Vice President', 'image' => null, 'link' => null, 'order' => 4],
            ['name' => 'Ghulam Qadir Jatoi', 'role' => 'Information Secretary', 'image' => null, 'link' => null, 'order' => 5],
            ['name' => 'Fida Hussain Soomro', 'role' => 'Finance Secretary', 'image' => null, 'link' => null, 'order' => 6],
            ['name' => 'Allah Dino Khaskheli', 'role' => 'Organizing Secretary', 'image' => null, 'link' => null, 'order' => 7],
            ['name' => 'Rashid Ali Baloch', 'role' => 'Joint Secretary', 'image' => null, 'link' => null, 'order' => 8],
            ['name' => 'Aziz Ahmed Memon', 'role' => 'Press Secretary', 'image' => null, 'link' => null, 'order' => 9],
            ['name' => 'Yasir Ali Leghari', 'role' => 'Social Media Coordinator', 'image' => null, 'link' => null, 'order' => 10],
        ];

        foreach ($districtBodyMembers as $member) {
            Leader::query()->updateOrCreate(
                ['name' => $member['name'], 'category' => 'district_body'],
                [
                    'name' => $member['name'],
                    'role' => $member['role'],
                    'district' => 'District Dadu',
                    'category' => 'district_body',
                    'image' => $member['image'],
                    'link' => $member['link'],
                    'order' => $member['order'],
                    'is_active' => true,
                ]
            );
        }

        // 5. Union Councils
        $councils = [
            [
                'name' => 'UC Khairpur Nathan Shah',
                'image' => 'images.jpg',
                'order' => 1,
                'members' => [
                    ['role' => 'Chairman', 'name' => 'Haji Ghulam Murtaza', 'image' => 'images-6.jpg'],
                    ['role' => 'Vice Chairman', 'name' => 'Ali Hassan Lund', 'image' => '1755606233581.jpg'],
                    ['role' => 'Secretary', 'name' => 'Shoukat Ali Mahar', 'image' => 'Asif_Ali_Zardari_with_Obamas_cropped.jpg'],
                    ['role' => 'Additional Member', 'name' => 'Niaz Ahmed', 'image' => '0Ha8CGJO.jpg'],
                ],
            ],
            [
                'name' => 'UC Tando Allahyar',
                'image' => 'images-2.jpg',
                'order' => 2,
                'members' => [
                    ['role' => 'Chairman', 'name' => 'Ghulam Mustafa Kalhoro', 'image' => 'Asif_Ali_Zardari_with_Obamas_cropped.jpg'],
                    ['role' => 'Vice Chairman', 'name' => 'Sajjad Ali Kalhoro', 'image' => '1755606233581.jpg'],
                    ['role' => 'Secretary', 'name' => 'Imran Ali Kalhoro', 'image' => '0Ha8CGJO.jpg'],
                    ['role' => 'Additional Member', 'name' => 'Fareed Soomro', 'image' => '3-54.jpg'],
                ],
            ],
            [
                'name' => 'UC Johi',
                'image' => 'images-3.jpg',
                'order' => 3,
                'members' => [
                    ['role' => 'Chairman', 'name' => 'Mir Ahmed Ali Talpur', 'image' => '67adc394b0b22_humza-zehri.webp'],
                    ['role' => 'Vice Chairman', 'name' => 'Naveed Ahmed Talpur', 'image' => '67adc394b0b22_humza-zehri.webp'],
                    ['role' => 'Secretary', 'name' => 'Mumtaz Ali Talpur', 'image' => 'images-7.jpg'],
                    ['role' => 'Additional Member', 'name' => 'Aslam Tanoor', 'image' => 'images-6.jpg'],
                ],
            ],
            [
                'name' => 'UC Mehar',
                'image' => 'images-4.jpg',
                'order' => 4,
                'members' => [
                    ['role' => 'Chairman', 'name' => 'Muhammad Yousuf Brohi', 'image' => '1755606233581.jpg'],
                    ['role' => 'Vice Chairman', 'name' => 'Abdul Sattar Brohi', 'image' => 'images-7.jpg'],
                    ['role' => 'Secretary', 'name' => 'Younis Brohi', 'image' => 'Asif_Ali_Zardari_with_Obamas_cropped.jpg'],
                    ['role' => 'Additional Member', 'name' => 'Ghulam Nabi Brohi', 'image' => 'images-6.jpg'],
                ],
            ],
            [
                'name' => 'UC Sakrand',
                'image' => 'images-5.jpg',
                'order' => 5,
                'members' => [
                    ['role' => 'Chairman', 'name' => 'Niaz Ahmed Qureshi', 'image' => '0Ha8CGJO.jpg'],
                    ['role' => 'Vice Chairman', 'name' => 'Shahid Qureshi', 'image' => 'images-6.jpg'],
                    ['role' => 'Secretary', 'name' => 'Ahmed Jan Qureshi', 'image' => '1755606233581.jpg'],
                    ['role' => 'Additional Member', 'name' => 'Babar Ali Qureshi', 'image' => 'Asif_Ali_Zardari_with_Obamas_cropped.jpg'],
                ],
            ],
        ];

        foreach ($councils as $council) {
            UnionCouncil::query()->updateOrCreate(
                ['name' => $council['name']],
                $council
            );
        }

        // 6. Media Gallery Items
        $galleryItems = [
            ['image' => 'images-8.jpg', 'alt' => 'Party leaders welcoming a new member', 'title' => 'Welcoming New Members', 'category' => 'functions', 'is_featured_home' => true, 'order' => 1],
            ['image' => 'images-9.jpg', 'alt' => 'Party supporters gathered at a public rally', 'title' => 'Public Rally Dadu', 'category' => 'railes', 'is_featured_home' => true, 'order' => 2],
            ['image' => 'images-10.jpg', 'alt' => 'Party members at a district event', 'title' => 'District Convention', 'category' => 'functions', 'is_featured_home' => true, 'order' => 3],
            ['image' => 'images-11.jpg', 'alt' => 'District leaders meeting with party representatives', 'title' => 'Leadership Council', 'category' => 'moments', 'is_featured_home' => true, 'order' => 4],
            ['image' => '1146335_6723908_PPP_akhbar.webp', 'alt' => 'Supporters carrying party flags at a rally', 'title' => 'Party Flag Procession', 'category' => 'railes', 'is_featured_home' => true, 'order' => 5],
            ['image' => '1256615_83992_PPP_akhbar.webp', 'alt' => 'A public gathering of party supporters', 'title' => 'Public Gathering', 'category' => 'railes', 'is_featured_home' => true, 'order' => 6],
            ['image' => 'OIP-1-150x150.webp', 'alt' => 'Community members joining a party procession', 'title' => 'Community Procession', 'category' => 'moments', 'is_featured_home' => true, 'order' => 7],
            ['image' => 'l_255162_082824_updates-150x150.jpg', 'alt' => 'Local party members at a community function', 'title' => 'Community Outreach', 'category' => 'functions', 'is_featured_home' => true, 'order' => 8],
        ];

        foreach ($galleryItems as $item) {
            GalleryItem::query()->updateOrCreate(
                ['image' => $item['image']],
                $item
            );
        }
    }
}
