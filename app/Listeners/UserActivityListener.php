<?php

namespace App\Listeners;

use App\Events\UserActivityEvent;
use App\Models\UserActivityLog;

class UserActivityListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserActivityEvent $event)
    {
        UserActivityLog::create([
            'nipp' => $event->nipp,
            'name' => $event->name,
            'email' => $event->email,
            'role' => $event->role,
            'modify_user' => $event->modify_user,
            'date_time' => now(),
        ]);
    }
}
