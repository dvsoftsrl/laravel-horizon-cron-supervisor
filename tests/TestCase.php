<?php

namespace DvSoft\LaravelHorizonCronSupervisor\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use DvSoft\LaravelHorizonCronSupervisor\LaravelHorizonCronSupervisorServiceProvider;

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
