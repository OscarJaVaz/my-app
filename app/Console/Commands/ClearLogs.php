<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear log files';

    public function handle()
    {
        $logPath = storage_path('logs');

        if (File::exists($logPath)) {
            File::cleanDirectory($logPath);
            $this->info('Logs have been cleared!');
        } else {
            $this->error('Log directory not found.');
        }
    }
}
