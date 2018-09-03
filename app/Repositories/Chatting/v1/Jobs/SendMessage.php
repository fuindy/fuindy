<?php

namespace Fuindy\Repositories\Student\v1\Jobs;

use Fuindy\Repositories\Chatting\v1\Models\Chatting;
use Fuindy\Repositories\Chatting\v1\Models\ChattingFriend;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $chattingFriend = ChattingFriend::find($this->request->friend_id);

        if ($chattingFriend) {

            Chatting::create([
                'friend_id' => $chattingFriend->id,
                'from' => $chattingFriend->request_id,
                'to' => $chattingFriend->receiver_id,
                'content' => $this->request->post('content')
            ]);
        }
    }
}
