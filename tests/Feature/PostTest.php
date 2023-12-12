<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function test_create_post()
    // {
    //     $response = $this->post('/posts', [
    //         'title' => 'Test Post',
    //         'content' => 'This is a test post.',
    //     ]);

    //     $response->assertStatus(201); // Assuming you return 201 on successful creation

    //     $this->assertDatabaseHas('posts', [
    //         'title' => 'Test Post',
    //         'content' => 'This is a test post.',
    //     ]);
    // }
}
