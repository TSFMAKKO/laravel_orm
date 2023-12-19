<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Events\RepliesProcessed;


class YourJobName implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $commentId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($commentId)
    {
        //
        $this->commentId = $commentId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // 模擬耗時操作
        // sleep(rand(1, 7));
        echo "YouJob ";
        echo $this->commentId;

        $comment = Comment::find($this->commentId);
        $replies = Reply::with('comment')->where('comment_id', $comment->id)->get();

        // event(new RepliesProcessed($replies));
        // 返回結果

        
        // 發送事件
        event(new RepliesProcessed($replies));
        return ['aaa'=>'123'];

        // return "YouJob $this->aaa ";
        // $comment = Comment::find($comment_id);
        // $replies = Reply::with('comment')->where('comment_id', $comment->id)->get();
    }
}
