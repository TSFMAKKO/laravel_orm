<?php

namespace Database\Factories;

use App\Models\Post; // 添加這行

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'content' => $this->faker->paragraph,
            'post_id' => Post::inRandomOrder()->first()->id,
            // 'user_id' => User::inRandomOrder()->first()->id, // 从用户中随机选择一个用户的 ID
        ];
    }
}
