<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Transforming Rural Infrastructure: Clean Drinking Water & Road Networks Across District Dadu',
                'slug' => 'transforming-rural-infrastructure-clean-drinking-water-road-networks-dadu',
                'category' => 'Development & Welfare',
                'excerpt' => 'Under the leadership of Barrister Pir Mujeeb-ul-Haq, transformative water filtration plants and road development schemes have been inaugurated across rural union councils in District Dadu.',
                'content' => '<p>In line with the progressive manifesto of the Pakistan Peoples Party, comprehensive development initiatives are underway across District Dadu to provide essential public amenities to every citizen.</p>
<h3>Clean Water Filtration Plants for Remote Villages</h3>
<p>Clean and safe drinking water is a fundamental right. Through the coordinated efforts of district representatives and Sindh Government development allocations, modern reverse osmosis (RO) and solar-powered filtration units have been made operational across Johi, Mehar, and Khairpur Nathan Shah talukas.</p>
<p>These facilities ensure that over 45,000 rural residents now have daily access to tested, potable water, significantly reducing waterborne illnesses among children and families.</p>
<blockquote>“Our mission is not merely political representation; it is the tangible betterment of daily living standards for every family in District Dadu.” — Barrister Pir Mujeeb-ul-Haq</blockquote>
<h3>Connecting Communities Through Road Infrastructure</h3>
<p>Farm-to-market connectivity remains paramount for local agricultural producers. The recent completion of 38 kilometers of metalled link roads enables farmers to transport wheat, cotton, and vegetables directly to central markets with minimal logistical costs, boosting the local rural economy.</p>',
                'image' => 'images-8.jpg',
                'video' => null,
                'video_url' => null,
                'photos' => ['images-2.jpg', 'images-3.jpg', 'images-4.jpg'],
                'author_name' => 'Barrister Pir Mujeeb-ul-Haq',
                'author_role' => 'District President & MPA',
                'author_avatar' => 'mujeepir-1024x1024.png',
                'read_time' => '4 min read',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 640,
                'tags' => ['Development', 'Water Schemes', 'Infrastructure', 'District Dadu'],
            ],
            [
                'title' => 'District President Barrister Pir Mujeeb-ul-Haq Addresses Grand Workers Convention in Dadu',
                'slug' => 'barrister-pir-mujeeb-ul-haq-addresses-grand-workers-convention-dadu',
                'category' => 'Speeches & Statements',
                'excerpt' => 'A resounding display of unity and democratic resolve at the district workers convention, emphasizing grassroots engagement and public service.',
                'content' => '<p>Thousands of passionate party workers, local councilors, youth wing members, and community elders gathered at the Central District Secretariat for the Annual District Workers Convention.</p>
<p>Speaking to the mammoth gathering, District President Barrister Pir Mujeeb-ul-Haq paid tribute to the tireless sacrifices of grassroots jiyalas who continue to stand as the backbone of the party.</p>
<h3>Key Directives for District Office Bearers</h3>
<ul>
<li><strong>Direct Public Accessibility:</strong> Every tehsil and municipal body must maintain open grievance redressal counters for everyday public issues.</li>
<li><strong>Youth Mobilization:</strong> Expanding digital literacy, career counseling, and youth sports initiatives across all 52 Union Councils.</li>
<li><strong>Support for Vulnerable Families:</strong> Ensuring transparent reach of government social welfare programs to deserving widows, laborers, and underprivileged families.</li>
</ul>
<p>General Secretary Syed Naveed Ahmed Shah reiterated that the party’s strength stems from unbroken trust with the masses, urging activists to stay connected with every doorstep across the district.</p>',
                'image' => 'Mass-Rally-Beneath-a-Crescent-Flag.jpg',
                'video' => null,
                'video_url' => 'https://www.youtube.com/watch?v=ScMzIvxBSi4',
                'photos' => ['images-8.jpg', 'images-10.jpg', 'images-11.jpg'],
                'author_name' => 'PPP District Media Cell',
                'author_role' => 'Media & Information Secretariat',
                'author_avatar' => 'PPP-1024x564.png',
                'read_time' => '5 min read',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 890,
                'tags' => ['Workers Convention', 'Grassroots', 'Leadership', 'Dadu'],
            ],
            [
                'title' => 'Empowering Sindh’s Youth: Vocational Training & Digital Skills Initiative in Mehar & Johi',
                'slug' => 'empowering-youth-vocational-training-digital-skills-mehar-johi',
                'category' => 'Youth & Community',
                'excerpt' => 'A special youth empowerment program providing free computer courses, vocational diplomas, and freelance entrepreneurship coaching to over 1,200 students.',
                'content' => '<p>In today’s rapidly changing global economy, empowering the youth with future-ready skills is the single most impactful investment for our district.</p>
<p>The Youth Wing of Pakistan Peoples Party District Dadu, in collaboration with community education partners, has launched the <em>Dadu Digital & Technical Skills Academy</em>.</p>
<h3>Programs Offered</h3>
<ul>
<li>Full-stack Web & Mobile App Development basics</li>
<li>Freelancing, Graphic Design, and Content Creation workshops</li>
<li>Solar energy technician and electrical certification programs</li>
</ul>
<p>The first cohort of 350 graduates received their certificates last week, with over 40% female participation, demonstrating the party’s unwavering dedication to gender empowerment and inclusive progress.</p>',
                'image' => 'images-4.jpg',
                'author_name' => 'Syed Naveed Ahmed Shah',
                'author_role' => 'General Secretary, PPP District Dadu',
                'author_avatar' => 'gc-1024x1024.png',
                'read_time' => '3 min read',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(9),
                'views_count' => 415,
                'tags' => ['Youth Empowerment', 'Education', 'IT Skills', 'Mehar', 'Johi'],
            ],
            [
                'title' => 'Remembering Shaheed Mohtarma Benazir Bhutto: A Legacy of Democracy, Equality & Human Dignity',
                'slug' => 'remembering-shaheed-mohtarma-benazir-bhutto-legacy-democracy',
                'category' => 'Party News',
                'excerpt' => 'District Dadu observes solemn remembrance tributes honoring the vision, courage, and monumental sacrifices of Shaheed-e-Jamhooriat Mohtarma Benazir Bhutto.',
                'content' => '<p>The leadership, workers, and supporters of District Dadu joined hands across tehsils to commemorate the life, ideology, and selfless sacrifice of the Muslim world’s first elected female Prime Minister, Shaheed Mohtarma Benazir Bhutto.</p>
<p>Shaheed Bibi dedicated her entire life to constitutional supremacy, workers’ rights, poverty alleviation, and national harmony. Her visionary social safety net initiatives, including the revolutionary Benazir Income Support Program, continue to protect millions of vulnerable households across Pakistan.</p>
<p>Quran Khwani and distribution of food packages to the needy were held at party offices across Dadu, Mehar, K.N. Shah, and Johi.</p>',
                'image' => '2-1024x1024.png',
                'author_name' => 'PPP District Media Cell',
                'author_role' => 'Media & Information Secretariat',
                'author_avatar' => 'PPP-1024x564.png',
                'read_time' => '4 min read',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(14),
                'views_count' => 1120,
                'tags' => ['Shaheed Benazir Bhutto', 'Democracy', 'History', 'Tribute'],
            ],
            [
                'title' => 'Healthcare Expansion in K.N. Shah: Upgraded Rural Health Centers & Free Medical Camps',
                'slug' => 'healthcare-expansion-kn-shah-rural-health-centers-medical-camps',
                'category' => 'Development & Welfare',
                'excerpt' => 'Modern emergency response equipment, specialized pediatric care units, and bi-weekly mobile medical camps are transforming healthcare access in Khairpur Nathan Shah.',
                'content' => '<p>Ensuring accessible, quality healthcare for all segments of society is a core priority of the Pakistan Peoples Party administration in Sindh.</p>
<p>Following comprehensive renovations, the Taluka Hospital in Khairpur Nathan Shah now features enhanced diagnostic ultrasound facilities, modern gynecological suites, and a fully stocked 24/7 emergency pharmacy offering free prescribed medications to patients.</p>
<p>In addition, specialized doctors from Hyderabad and Karachi conducted a 3-day multi-specialty medical camp in surrounding union councils, providing screenings, eye checks, and free medicines to more than 3,400 local residents.</p>',
                'image' => 'images-2.jpg',
                'author_name' => 'PPP District Media Cell',
                'author_role' => 'Media Coordinator',
                'author_avatar' => 'PPP-1024x564.png',
                'read_time' => '4 min read',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(18),
                'views_count' => 520,
                'tags' => ['Healthcare', 'Public Health', 'KN Shah', 'Medical Camp'],
            ],
            [
                'title' => 'PPP District Dadu Launches Comprehensive Grassroots Membership Drive Across 52 Union Councils',
                'slug' => 'ppp-district-dadu-launches-grassroots-membership-drive-52-union-councils',
                'category' => 'Press Releases',
                'excerpt' => 'Official announcement of digital and door-to-door membership registration campaign uniting farmers, laborers, teachers, professionals, and students.',
                'content' => '<p>The District Executive Committee of Pakistan Peoples Party District Dadu has officially inaugurated its District-wide Membership Drive 2026.</p>
<p>With dedicated registration desks established at each Tehsil and Union Council center, alongside the seamless online membership portal on this official website, citizens from all walks of life are invited to formalize their membership in the party.</p>
<p>Citizens can apply directly online through the Members Area or Join page, selecting their wing of interest including Primary Membership, Youth Wing, Women Wing, or Professionals Forum.</p>',
                'image' => 'images-10.jpg',
                'author_name' => 'Syed Naveed Ahmed Shah',
                'author_role' => 'General Secretary',
                'author_avatar' => 'gc-1024x1024.png',
                'read_time' => '3 min read',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(24),
                'views_count' => 780,
                'tags' => ['Membership', 'Online Portal', 'Press Release', 'Grassroots'],
            ],
        ];

        foreach ($articles as $article) {
            Blog::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
