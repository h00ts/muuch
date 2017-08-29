<?php

namespace App\Listeners;

use App\Events\PageView;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogPageView
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
     * @param  PageView  $event
     * @return void
     */
    public function handle(PageView $event)
    {
        $activity = activity()
            ->performedOn($event->page)
            ->causedBy($event->user)
            ->log('Vio la página');

        $lastLoggedActivity = Activity::all()->last();
    }
}
