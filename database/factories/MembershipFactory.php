<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_type' => fake()->randomElement(['Primary Member', 'General Member', 'Youth Wing', 'Women Wing']),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'profile_picture' => null,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email_address' => fake()->safeEmail(),
            'mobile_number' => '03'.fake()->numerify('#########'),
            'cnic_number' => '42101'.fake()->numerify('#######').'1',
            'date_of_birth' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'education' => fake()->randomElement(['Matriculation', 'Intermediate', 'Bachelor', 'Master']),
            'profession' => fake()->randomElement(['Teacher', 'Advocate', 'Doctor', 'Businessman', 'Farmer']),
            'resident_type' => 'Pakistani',
            'province' => 'Sindh',
            'division' => 'Hyderabad',
            'district' => 'Dadu',
            'tehsil_city' => fake()->randomElement(['Dadu', 'Mehar', 'Khairpur Nathan Shah', 'Johi']),
            'current_address' => fake()->streetAddress(),
            'permanent_address' => fake()->streetAddress(),
            'facebook_url' => null,
            'twitter_url' => null,
            'instagram_url' => null,
            'tiktok_url' => null,
            'volunteering' => fake()->randomElements(['Polling Agent', 'Social Causes', 'Member Drive', 'Legal Aid'], 2),
            'status' => 'new',
            'is_read' => false,
        ];
    }
}
