<?php

use DvSoft\LaravelHorizonCronSupervisor\Commands\LaravelHorizonCronSupervisorCommand;
use Illuminate\Support\Facades\Artisan;

it('starts horizon when status output says it is not running', function () {
    Artisan::swap(new class
    {
        public function call($command): int
        {
            expect($command)->toBe('horizon:status');

            return 0;
        }

        public function output(): string
        {
            return 'Horizon is inactive.';
        }
    });

    $command = new class extends LaravelHorizonCronSupervisorCommand
    {
        public array $calledCommands = [];

        public function call($command, array $arguments = [])
        {
            $this->calledCommands[] = $command;

            return self::SUCCESS;
        }

        public function comment($string, $verbosity = null)
        {
        }
    };

    expect($command->handle())->toBe(LaravelHorizonCronSupervisorCommand::SUCCESS)
        ->and($command->calledCommands)->toBe(['horizon']);
});

it('does not start horizon when it is already running', function () {
    Artisan::swap(new class
    {
        public function call($command): int
        {
            expect($command)->toBe('horizon:status');

            return 0;
        }

        public function output(): string
        {
            return 'Horizon is running.';
        }
    });

    $command = new class extends LaravelHorizonCronSupervisorCommand
    {
        public array $calledCommands = [];

        public function call($command, array $arguments = [])
        {
            $this->calledCommands[] = $command;

            return self::SUCCESS;
        }

        public function comment($string, $verbosity = null)
        {
        }
    };

    expect($command->handle())->toBe(LaravelHorizonCronSupervisorCommand::SUCCESS)
        ->and($command->calledCommands)->toBe([]);
});
