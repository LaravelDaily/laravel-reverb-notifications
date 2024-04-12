<?php

namespace App\Console\Commands;

use App\Events\SystemMaintenanceEvent;
use Illuminate\Console\Command;

class SystemNotifyMaintenanceCommand extends Command
{
    protected $signature = 'system:notify-maintenance';

    protected $description = 'Command description';

    public function handle(): void
    {
        $time = $this->ask('When should it happen?');

        event(new SystemMaintenanceEvent($time));
    }
}
