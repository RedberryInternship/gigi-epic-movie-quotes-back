<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldBroadcast
{
	use Dispatchable;

	use InteractsWithSockets;

	use SerializesModels;

	public $notification;

	public function __construct($notification)
	{
		$this->notification = $notification;
	}

	public function broadcastOn()
	{
		return new PrivateChannel('notification.' . $this->notification->user_id);
	}
}
