<?php

namespace DvSoft\LaravelHorizonCronSupervisor\Tests;

use DvSoft\LaravelHorizonCronSupervisor\LaravelHorizonCronSupervisorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
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
    }
}
