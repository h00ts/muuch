<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Spatie\Activitylog\Models\Activity;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $activity = activity()
            ->performedOn($event->user)
            ->causedBy($event->user)
            ->log('Ingresó');

        $lastLoggedActivity = Activity::all()->last();
    }
}
