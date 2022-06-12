<?php

namespace DvSoft\LaravelHorizonCronSupervisor;

use Illuminate\Console\Scheduling\Schedule;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use DvSoft\LaravelHorizonCronSupervisor\Commands\LaravelHorizonCronSupervisorCommand;

class LaravelHorizonCronSupervisorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-horizon-cron-supervisor')
            ->hasCommand(LaravelHorizonCronSupervisorCommand::class);
    }

    public function packageBooted()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('supervisor:check')->everyThreeMinutes();
        });
    }
}
