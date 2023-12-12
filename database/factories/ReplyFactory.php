<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 获取 Comment 模型的所有 ID，以便随机分配给 reply
        $commentIds = Comment::pluck('id')->toArray();
        return [
            //
            'content' => $this->faker->paragraph,
            'comment_id' => $this->faker->randomElement($commentIds),
            
        ];
    }
}
