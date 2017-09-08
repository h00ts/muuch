<?php

namespace App\Listeners;

use App\Events\ContentCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\Models\Activity;

class LogContentView
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
     * @param  ContentView  $event
     * @return void
     */
    public function handle(ContentCompleted $event)
    {
        $activity = activity()
            ->performedOn($event->content)
            ->causedBy($event->user)
            ->log('Completó');

        $lastLoggedActivity = Activity::all()->last();
    }
}
