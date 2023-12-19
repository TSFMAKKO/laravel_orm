<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Foundation\Bus\Dispatchable;

use App\Events\RepliesProcessed;

class ProcessRepliesJob implements ShouldQueue

{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    protected $commentId;

    /**
     * Create a new job instance.
     *
     * @param int $commentId
     */
    public function __construct($commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = Comment::find($this->commentId);
        $replies = Reply::with('comment')->where('comment_id', $comment->id)->get();

        // 在這裡處理你的邏輯，例如將結果存儲在某個地方
        // ...

        // 如果你需要將結果返回給控制器，你可以使用 Laravel 的事件系統或緩存等方法

        // 例如，使用 Laravel 事件：
        // event(new RepliesProcessed($replies));
        sleep(rand(0.1, 2));
        // 發送事件
        event(new RepliesProcessed($replies));
        // 返回結果
        return $replies;


    }
}
