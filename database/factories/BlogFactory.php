<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'category' => fake()->randomElement(['Development & Welfare', 'Party News', 'Press Releases', 'Speeches & Statements', 'Youth & Community']),
            'excerpt' => fake()->paragraph(2),
            'content' => '<p>'.implode('</p><p>', fake()->paragraphs(4)).'</p>',
            'image' => fake()->randomElement(['images-8.jpg', 'images-2.jpg', 'images-3.jpg', 'images-4.jpg', 'images-10.jpg', 'Mass-Rally-Beneath-a-Crescent-Flag.jpg']),
            'author_name' => fake()->randomElement(['PPP District Media Cell', 'Barrister Pir Mujeeb-ul-Haq', 'Syed Naveed Ahmed Shah', 'Youth Wing Secretariat']),
            'author_role' => fake()->randomElement(['Media Coordinator', 'District President', 'General Secretary', 'Communications Secretary']),
            'author_avatar' => 'mujeepir-1024x1024.png',
            'read_time' => fake()->randomElement(['3 min read', '4 min read', '5 min read', '6 min read']),
            'is_featured' => false,
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'views_count' => fake()->numberBetween(25, 1200),
            'tags' => ['PPP', 'District Dadu', 'Sindh', 'Public Welfare'],
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
