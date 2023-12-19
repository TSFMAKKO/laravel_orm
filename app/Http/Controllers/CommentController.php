<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

class CommentController extends Controller
{

    public function index($post_id)
    {
        // dd($post_id);
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];

        // echo "$post_id";

        $post = post::find($post_id);
        // $comments = Comment::with('user')->with('post')->where('post_id', $post->id)->withCount('replies')->get();
        $comments = Comment::with('user')
            ->withCount('replies')
            ->where('post_id', $post->id)
            ->get();
        // 產生 1 到 3 之間的隨機秒數
        $randomSeconds = rand(1, 3);

        // 暫停隨機秒數
        sleep($randomSeconds);


        echo $comments->toJson();
        // echo $comments->toJson();
        // echo json_encode($comments);
        // dd($comments);

        // return view('post', compact('post','comments'));
    }
}
