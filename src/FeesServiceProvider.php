<?php

namespace Eventat\Fees;

use Eventat\Fees\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class FeesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->commands([
            InstallCommand::class,
        ]);
    }
}
