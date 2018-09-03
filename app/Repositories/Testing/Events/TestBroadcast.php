<?php

namespace Fuindy\Events;

use Fuindy\Repositories\Notifications\v1\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $broadcastQueue = 'broadcaster';

    public $customerId;

    public $title;
    public $message;
    public $url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customerId, $notificationId)
    {
        $this->customerId = $customerId;
        $notification = Notification::find($notificationId);

        if ($notification) {
            $this->title = $notification->title;
            $this->message = $notification->message;
            $this->url = $notification->url;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notify.' . $this->customerId);
    }
}
