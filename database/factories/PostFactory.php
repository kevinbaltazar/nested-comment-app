<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 1,
            'title' => 'Lorem ipsum dolor sit amet.',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur quia saepe aliquam nemo pariatur sed aut voluptas eveniet aspernatur dolore!'
        ];
    }
}
