<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActivityEvent
{
    use Dispatchable, SerializesModels;

    public $nipp;
    public $name;
    public $email;
    public $role;
    public $modify_user;
    public $action;

    public function __construct($nipp, $name, $email, $role, $modify_user, $action)
    {
        $this->nipp = $nipp;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->modify_user = $modify_user;
        $this->action = $action;
    }

    public function broadcastOn()
    {
        return new Channel('channel-name');
    }
}
