<?php

namespace Qihucms\SiteAd\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Qihucms\SiteAd\Models\SiteAd;
use Qihucms\UserTask\Models\UserTaskOrder;

class SiteAdUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ad;

    /**
     * Create a new event instance.
     *
     * @param SiteAd $ad
     * @return void
     */
    public function __construct(SiteAd $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('site.ad.' . $this->ad->user_id);
    }
}
