<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Broadcast;

class SystemNotifyMaintenanceCommand extends Command
{
    protected $signature = 'system:notify-maintenance';

    protected $description = 'Command description';

    public function handle(): void
    {
        $time = $this->ask('When should it happen?');

        Broadcast::on('system-maintenance')
            ->as('App\\Events\\SystemMaintenanceEvent')
            ->with([
                'time' => $time
            ])
            ->via('reverb')
            ->send();
    }
}
