<?php

namespace Tests\Feature;

use Database\Seeders\WebsiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_district_information_and_frontend_assets(): void
    {
        $this->seed(WebsiteContentSeeder::class);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Pakistan Peoples Party')
            ->assertSee('District Dadu')
            ->assertSee('Assets/video/hero-section-bg.mp4')
            ->assertSee('About President')
            ->assertSee('Media Gallery')
            ->assertSee('Our Leadership')
            ->assertSee('id="leadershipCarousel"', false)
            ->assertSee('id="activitiesCarousel"', false)
            ->assertSee('aria-label="Next leadership"', false)
            ->assertSee('aria-label="Next activities"', false)
            ->assertSee('Upcoming Events')
            ->assertSee('Moments from Our activities')
            ->assertSee('Join Hands For a Better Future')
            ->assertSee('25+')
            ->assertSee(route('pages.president'))
            ->assertSee('Assets/css/bootstrap.css')
            ->assertSee('Assets/css/all.css')
            ->assertSee('Assets/js/jquery.min.js')
            ->assertSee('Assets/js/bootstrap.bundle.min.js')
            ->assertSee('css/site.css')
            ->assertSee('js/site.js');
    }
}
