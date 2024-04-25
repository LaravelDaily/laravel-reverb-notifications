<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Broadcast;

class ExportPdfDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $userId)
    {
    }

    public function handle(): void
    {
        sleep(5);

        Broadcast::private('App.Models.User.' . $this->userId)
            ->as('App\\Events\\ExportFinishedEvent')
            ->with([
                'user_id' => $this->userId,
                'file_path' => 'file.pdf',
            ])
            ->via('reverb')
            ->send();
    }
}
