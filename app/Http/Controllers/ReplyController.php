<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

// 在控制器中的某個方法中推送佇列任務
use App\Jobs\YourJobName;
use App\Jobs\ProcessRepliesJob;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;

// public function someMethod()
// {
//     YourJobName::dispatch();
// }


class ReplyController extends Controller
{

    public function index($comment_id)
    {
        // dd($post_id);
        // $posts = [
        //     ['id' => 1, 'title' => 'Post 1'],
        //     ['id' => 2, 'title' => 'Post 2'],
        //     // 其他文章
        // ];


        $comment = Comment::find($comment_id);
        // $replies = Reply::with('user','comment')->where('comment_id', $comment->id)->get();
        
        $replies = Reply::with('user')->where('comment_id', $comment->id)->get();
        // dd($replies);
        // dd($comments->post->title);
        // foreach ($replies as $key => $reply) {
        //     # code...
        //     echo "$reply->id. $reply->content<br>";
        // }
        // 產生 1 到 3 之間的隨機秒數
        // 可以工作 但無法回傳(當背景使用)

        // Job類似把函數寫在外層  可以用同步或非同步來執行
        YourJobName::dispatch($comment_id);

        // echo "replies:".$replies;
        // ProcessRepliesJob::dispatch($comment_id);
        // $dispatcher=new \Illuminate\Contracts\Bus\Dispatcher; 



        // 可以工作 可以回 同步
        // $replies = Bus::dispatchNow(new ProcessRepliesJob($comment_id));

        // $replies = Bus::dispatchSync(new ProcessRepliesJob($comment_id));


        // $replies = PendingDispatch::dispatchNow(new ProcessRepliesJob($comment_id));
        // $randomSeconds = rand(0.1, 2);

        // 暫停隨機秒數
        // sleep($randomSeconds);
        echo json_encode($replies);

        // return view('post', compact('post','comments'));
    }
}
