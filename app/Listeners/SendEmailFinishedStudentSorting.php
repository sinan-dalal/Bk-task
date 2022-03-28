<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\AdminEmail;
use Illuminate\Support\Facades\Notification;

class SendEmailFinishedStudentSorting
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::all();

        Notification::send($user, new AdminEmail($event->message));
    }
}
