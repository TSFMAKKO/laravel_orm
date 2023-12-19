<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

use App\Models\User;

class PostController extends Controller
{
    public function show()
    {
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];

        $posts = Post::get();

        // dd($posts);

        return view('posts.index', compact('posts'));
    }

    public function index($post_id)
    {
        // dd($post_id);
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];

        $post = Post::with('user')->find($post_id);

        // dd($post->user);
        // $comments=Comment::with('Post');
        // $comments = Comment::with('user','post')->where('post_id', $post->id)->withCount('replies')->get();

        $comments = Comment::where('post_id', $post->id)->withCount('replies')->get();

        // dd(count($comments[0]->replies));

        $comment = Comment::find(1);
        // $replies = Reply::with('comment')->where('comment_id', $comment->id)->get();
        // dd($replies);
        // dd($comments->post->title);

        return view('post', compact('post', 'comments'));
    }
}
