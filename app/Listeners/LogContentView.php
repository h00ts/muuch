<?php

namespace App\Listeners;

use App\Events\ContentView;
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
    public function handle(ContentView $event)
    {
        $activity = activity()
            ->performedOn($event->content)
            ->causedBy($event->user)
            ->log('Entro al contenido');

        $lastLoggedActivity = Activity::all()->last();
    }
}
