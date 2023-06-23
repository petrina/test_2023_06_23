<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostTranslation>
 */
class PostTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id'=>Post::inRandomOrder()->value('id'),
            'language_id'=>Language::inRandomOrder()->value('id'),
            'title'=>fake()->sentence,
            'content'=>fake()->paragraph,
            'description'=>fake()->text
        ];
    }
}
