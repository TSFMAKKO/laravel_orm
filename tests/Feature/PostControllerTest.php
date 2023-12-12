<?php

// tests/Feature/PostControllerTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostIndex()
    {
        // 访问控制器的 index 方法
        $response = $this->get('/posts');

        // 断言响应状态码为 200
        $response->assertStatus(200);

        // 断言视图包含指定文本(h1)
        $response->assertSee('Posts');

        // 断言视图包含指定文本(針對哪個模板)
        // 檢查是否是使用posts\index.blade.php
        $response->assertViewIs('posts.index');

        // 输出实际的 HTML 内容
        // $response->dump();

        // 检查响应 HTML 中的 <title> 元素是否包含 "Post Index"
        // $response->assertSee('<title>Post Index</title>');


        // 检查响应 HTML 中的 <title> 元素内容是否按照顺序包含 "Post Index"
        // $response->assertSeeInOrder(['<title>', 'Post Index', '</title>']);

        // 在li
        $response->assertSee('Post 1');
        $response->assertSee('Post 2');
    }
}
