<?php

namespace Database\Factories;

use App\Models\WebsiteSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebsiteSubmission>
 */
class WebsiteSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submission_type' => 'contact',
            'payload' => [
                'full_name' => fake()->name(),
                'cnic_number' => fake()->numerify('#####-#######-#'),
                'contact_type' => 'General inquiry',
                'message' => fake()->sentence(),
            ],
        ];
    }
}
