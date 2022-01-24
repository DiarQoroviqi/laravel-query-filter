<?php

namespace Deviar\LaravelQueryFilter;

use Deviar\LaravelQueryFilter\Commands\MakeFilterCommand;
use Illuminate\Support\ServiceProvider;

class LaravelQueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilterCommand::class,
            ]);
        }
    }
}
