<?php

namespace Tests\Feature;

use App\Models\Membership;
use App\Models\User;
use Database\Seeders\MembershipSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSubmissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_membership_records_count_and_list(): void
    {
        $this->seed(MembershipSeeder::class);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('10');
        $response->assertSee('Online Memberships');
    }

    public function test_admin_memberships_page_lists_all_members_from_directory(): void
    {
        $member = Membership::factory()->create([
            'first_name' => 'Ghulam',
            'last_name' => 'Murtaza',
            'cnic_number' => '4210111111111',
            'member_type' => 'Primary Member',
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.submissions.memberships'));

        $response->assertOk();
        $response->assertSee('Ghulam Murtaza');
        $response->assertSee('4210111111111');
        $response->assertSee('Primary Member');
    }

    public function test_admin_can_update_status_and_delete_membership(): void
    {
        $member = Membership::factory()->create([
            'first_name' => 'Ali',
            'last_name' => 'Khan',
            'cnic_number' => '4210199999991',
            'status' => 'new',
        ]);

        $user = User::factory()->create();

        // Update status to approved directly on membership
        $this->actingAs($user)->patch(route('admin.submissions.memberships.status', $member), [
            'status' => 'approved',
        ])->assertRedirect();

        $this->assertSame('approved', $member->fresh()->status);

        // Delete membership directly
        $this->actingAs($user)->delete(route('admin.submissions.memberships.destroy', $member))->assertRedirect();

        $this->assertDatabaseMissing('memberships', ['id' => $member->id]);
    }
}
