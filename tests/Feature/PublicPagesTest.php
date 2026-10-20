<?php

namespace Tests\Feature;

use App\Models\WebsiteSubmission;
use Database\Seeders\WebsiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_pages_from_the_original_site_are_available_from_the_homepage(): void
    {
        $this->seed(WebsiteContentSeeder::class);

        $pages = [
            'pages.president' => 'Barrister Pir Mujeeb-ul-Haq',
            'pages.general-secretary' => 'Syed Naveed Ahmed Shah',
            'pages.district-body' => 'Haji Abdul Rehman',
            'pages.tehsil-bodies' => 'Tehsil Dadu',
            'pages.municipal-bodies' => 'Local Representatives',
            'pages.union-council-bodies' => 'Haji Ghulam Murtaza',
            'pages.media-gallery' => 'Media Gallery',
            'pages.members' => 'Members',
            'pages.join' => 'Join Pakistan Peoples Party Today!',
            'pages.contact' => 'Send your',
        ];

        $homepage = $this->get(route('home'))->assertOk();

        foreach ($pages as $routeName => $expectedText) {
            $url = route($routeName);

            $homepage->assertSee($url);
            $page = $this->get($url)->assertOk()->assertSee($expectedText);

            if ($routeName === 'pages.president') {
                $page->assertSee('Mission')
                    ->assertSee('Vision')
                    ->assertSee('Our Journey of')
                    ->assertSee('Achievements')
                    ->assertSee('100k+')
                    ->assertSee('Join PPP Today')
                    ->assertSee('Healthcare Initiatives');
            }

            if ($routeName === 'pages.general-secretary') {
                $page->assertSee('About Our')
                    ->assertSee('General Secretary')
                    ->assertSee('100+')
                    ->assertSee('Party workers')
                    ->assertSee('Committed to the')
                    ->assertSee('Transparency')
                    ->assertSee('Join PPP Today');
            }

            if ($routeName === 'pages.district-body') {
                $page->assertSee('Senior Vice President')
                    ->assertSee('Social Media Coordinator')
                    ->assertSee('District <span>Body</span>', false)
                    ->assertSee('Our <span>Responsibilities</span>', false)
                    ->assertSee('100+', false)
                    ->assertSee('10k+', false)
                    ->assertSee('bdb31113-7f3c-41d4-8673-11cdb7bacf93.png');
            }

            if ($routeName === 'pages.tehsil-bodies') {
                $page->assertSee('Tehsil Dadu')
                    ->assertSee('Tehsil Mehar')
                    ->assertSee('Tehsil Khairpur Nathan Shah')
                    ->assertSee('Tehsil Johi')
                    ->assertSee('tehsil-bodies-statistics', false)
                    ->assertSee('tehsil-bodies-priorities', false)
                    ->assertSee('tehsil-bodies-impact', false);
            }

            if ($routeName === 'pages.municipal-bodies') {
                $page->assertSee('Municipal <span>&amp; Town Bodies</span>', false)
                    ->assertSee('municipal-bodies-statistics', false)
                    ->assertSee('Municipal Committees')
                    ->assertSee('Town Committees')
                    ->assertSee('50+')
                    ->assertSee('Better Governance')
                    ->assertSee('Local Development')
                    ->assertSee('Community Support')
                    ->assertSee('Public Welfare')
                    ->assertSee('Local Representatives')
                    ->assertSee('municipal-bodies-impact', false);

                $this->assertSame(5, substr_count($page->getContent(), 'class="municipal-bodies-stat"'));
                $this->assertSame(4, substr_count($page->getContent(), 'class="municipal-bodies-priority"'));
            }

            if ($routeName === 'pages.union-council-bodies') {
                $page->assertSee('Vice Chairman')
                    ->assertSee('UC Tando Allahyar')
                    ->assertSee('Babar Ali Qureshi')
                    ->assertSee('Municipal Committees')
                    ->assertSee('Local Projects')
                    ->assertSee('10k+')
                    ->assertSee('union-council-5')
                    ->assertSee('images-5.jpg')
                    ->assertSee('union-council-join');
            }

            if ($routeName === 'pages.media-gallery') {
                $page->assertSee('data-gallery-filter="all"', false)
                    ->assertSee('data-gallery-filter="functions"', false)
                    ->assertSee('data-gallery-filter="railes"', false)
                    ->assertSee('data-gallery-filter="moments"', false)
                    ->assertSee('Working for Stronger Communities')
                    ->assertSee('1146335_6723908_PPP_akhbar.webp')
                    ->assertSee('l_255162_082824_updates-150x150.jpg')
                    ->assertSee('media-gallery-card', false);

                $this->assertSame(8, substr_count($page->getContent(), 'class="col-6 col-md-4 col-lg-3 media-gallery-card"'));
            }

            if ($routeName === 'pages.members') {
                $page->assertSee('Members')
                    ->assertSee('Area')
                    ->assertSee('Total Members')
                    ->assertSee('Primary Members')
                    ->assertSee('Youth Wing')
                    ->assertSee('Women Wing');
            }

            if ($routeName === 'pages.join') {
                $page->assertSee('Join Pakistan Peoples Party Today!')
                    ->assertSee('name="member_type"', false)
                    ->assertSee('name="gender"', false)
                    ->assertSee('name="profile_picture"', false)
                    ->assertSee('name="first_name"', false)
                    ->assertSee('name="last_name"', false)
                    ->assertSee('name="email_address"', false)
                    ->assertSee('name="mobile_number"', false)
                    ->assertSee('name="cnic_number"', false)
                    ->assertSee('name="date_of_birth"', false)
                    ->assertSee('name="education"', false)
                    ->assertSee('name="profession"', false)
                    ->assertSee('name="resident_type"', false)
                    ->assertSee('name="province"', false)
                    ->assertSee('name="division"', false)
                    ->assertSee('name="district"', false)
                    ->assertSee('name="tehsil_city"', false)
                    ->assertSee('name="current_address"', false)
                    ->assertSee('name="permanent_address"', false)
                    ->assertSee('name="facebook_url"', false)
                    ->assertSee('name="twitter_url"', false)
                    ->assertSee('name="instagram_url"', false)
                    ->assertSee('name="tiktok_url"', false)
                    ->assertSee('Volunteering Preferences')
                    ->assertSee('not a robot')
                    ->assertSee('Submit');
            }

            if ($routeName === 'pages.contact') {
                $page->assertSee('Suggestions/ <span>Complaints/</span> <strong>Contacts</strong>', false)
                    ->assertSee('We are</span> listening', false)
                    ->assertSee('Your Voice Matters')
                    ->assertSee('Quick Response')
                    ->assertSee('Better Tomorrow')
                    ->assertSee('Send your</span> Suggestion/ Complaint', false)
                    ->assertSee('name="contact_type"', false)
                    ->assertSee('name="message"', false)
                    ->assertSee('Working for Stronger Communities')
                    ->assertSee('contact-impact', false);
            }
        }
    }

    public function test_membership_submission_is_saved_with_encrypted_personal_data(): void
    {
        $cnic = '42101-1234567-1';
        $firstName = 'Example';
        $lastName = 'Applicant';
        $name = 'Example Applicant';

        $this->from(route('pages.join'))
            ->post(route('pages.join.store'), [
                'member_type' => 'Primary Member',
                'gender' => 'Male',
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email_address' => 'applicant@example.com',
                'mobile_number' => '03001234567',
                'cnic_number' => $cnic,
                'date_of_birth' => '1990-06-15',
                'education' => 'Bachelor',
                'profession' => 'Teacher',
                'resident_type' => 'Pakistani',
                'province' => 'Sindh',
                'division' => 'Hyderabad',
                'district' => 'Dadu',
                'tehsil_city' => 'Johi',
                'current_address' => 'Example Street, Dadu',
                'permanent_address' => 'Example Permanent Street, Dadu',
                'facebook_url' => 'https://facebook.com/example',
                'twitter_url' => 'https://twitter.com/example',
                'instagram_url' => 'https://instagram.com/example',
                'tiktok_url' => 'https://tiktok.com/@example',
                'volunteering' => ['Polling Agent', 'Social Causes'],
            ])
            ->assertRedirect(route('pages.join'))
            ->assertSessionHas('status', 'Your membership application has been received.');

        $submission = WebsiteSubmission::query()->firstOrFail();
        $this->assertSame('membership', $submission->submission_type);
        $this->assertSame($name, $submission->payload['full_name']);
        $this->assertSame('4210112345671', $submission->payload['cnic_number']);

        $encryptedPayload = DB::table('website_submissions')->value('payload');
        $this->assertIsString($encryptedPayload);
        $this->assertStringNotContainsString($name, $encryptedPayload);
        $this->assertStringNotContainsString('4210112345671', $encryptedPayload);
    }

    public function test_invalid_contact_submission_does_not_flash_sensitive_form_values(): void
    {
        $this->from(route('pages.contact'))
            ->post(route('pages.contact.store'), [
                'full_name' => 'Example Contact',
                'cnic_number' => 'not-a-valid-cnic',
                'contact_type' => 'Suggestion',
                'message' => 'A suggestion for the district.',
            ])
            ->assertRedirect(route('pages.contact'))
            ->assertSessionHasErrors('cnic_number')
            ->assertSessionMissing('_old_input');

        $this->assertDatabaseCount('website_submissions', 0);
    }
}
