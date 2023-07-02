<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
     // Faz o mesmo que  $this->app->bind
    // public array $bindings =[
    //     'App\Models\Model' => 'App\Policies\ModelPolicy',
    // ];

    /**
     * Register services.
     *
     * @return void
     */

    // Executado para ensinar o service container o que fazer
    public function register()
    {
        // $this->app->bind(): Para ligar uma interface a uma classe concreta
        $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
