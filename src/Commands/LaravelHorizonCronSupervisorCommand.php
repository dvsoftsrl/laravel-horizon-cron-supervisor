<?php

namespace DvSoft\LaravelHorizonCronSupervisor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class LaravelHorizonCronSupervisorCommand extends Command
{
    public $signature = 'supervisor:check';

    public $description = 'Checks if Horizon is running, start it if needed.';

    public function handle(): int
    {

        Artisan::call('horizon:status');

        $res = Artisan::output();

        if (!Str::contains($res, 'Horizon is running')) {
            $this->comment('Horizon is not running, starting it');

            $this->call('horizon');
        } else {
            $this->comment($res);
        }

        return self::SUCCESS;
    }
}
