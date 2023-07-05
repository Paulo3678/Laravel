<?php

namespace App\Listeners;

use App\Events\SeriesDestroyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class RemoveSeriesImageFromDir
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
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesDestroyed $event)
    {
        Storage::disk('public')->delete($event->coverPath);
    }
}
