<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserRegisteredNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        if ($event->user) {
            $event->user->notify(new UserRegisteredNotification());
        } else {
            \Log::error('User is null in UserRegistered event.');
        }
    }
}
