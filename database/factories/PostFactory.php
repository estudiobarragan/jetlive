<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'         => $this->faker->sentence,
            'content'       => $this->faker->paragraphs(5),
            'image_path'    => $this->faker->imageUrl(),
            'category_id'   => 1,
            'tag_id'        => 1,
            'user_id'       => 1,
        ];
    }
}
