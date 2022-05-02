<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application logs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $s = Storage::disk('logs');
        $files = array_filter($s->allFiles(), function ($file) {
            return $file != '.gitignore';
        });
        $s->delete($files);
    }
}
