<?php

use DvSoft\LaravelHorizonCronSupervisor\LaravelHorizonCronSupervisorServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

it('registers the supervisor check command in the scheduler', function () {
    $schedule = app(Schedule::class);

    $expectedEvent = $schedule->command('supervisor:check')->everyThreeMinutes();

    $eventsProperty = new ReflectionProperty($schedule, 'events');
    $eventsProperty->setAccessible(true);
    $eventsProperty->setValue($schedule, []);

    (new LaravelHorizonCronSupervisorServiceProvider(app()))->packageBooted();

    $event = collect($schedule->events())
        ->first(fn ($event) => $event->command === $expectedEvent->command);

    expect($event)->not->toBeNull()
        ->and($event->expression)->toBe($expectedEvent->expression);
});
