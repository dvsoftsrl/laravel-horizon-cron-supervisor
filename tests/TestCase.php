<?php

namespace DvSoft\LaravelHorizonCronSupervisor\Tests;

use DvSoft\LaravelHorizonCronSupervisor\LaravelHorizonCronSupervisorServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Testbench 9 resets this property during setup.
     *
     * @var mixed
     */
    public static $latestResponse;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::command('horizon:status', function (): void {
            $this->line((string) config('testing.horizon_status_output', 'Horizon is running.'));
        });

        Artisan::command('horizon', function (): void {
            app()->instance('testing.horizon_started', true);
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelHorizonCronSupervisorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('testing.horizon_started', false);
    }
}
