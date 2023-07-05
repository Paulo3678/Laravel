<?php

namespace App\Listeners;

use App\Events\SeriesCreate;
use App\Events\SeriesCreated;
use App\Repositories\SeriesRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InsertNewSerie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private SeriesRepository $repository)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreate $event)
    {
        $serie = $this->repository->add($event->request);

        $seriesCreatedEvent = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $event->request->seasonsQty,
            $event->request->episodesPerSeason
        );

        event($seriesCreatedEvent);
    }
}
