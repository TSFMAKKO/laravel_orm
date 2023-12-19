<?php

namespace App\Listeners;


use App\Events\RepliesProcessed;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RepliesProcessedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        $replies = $event->replies;

        // 在這裡處理接收到事件後的邏輯
        // ...


          // 如果你想要將結果返回給控制器，你可以使用 Laravel 的緩存、資料庫等方法
        // 例如，將結果存儲在緩存中
        cache()->put('processed_replies', $replies);

    }
}
