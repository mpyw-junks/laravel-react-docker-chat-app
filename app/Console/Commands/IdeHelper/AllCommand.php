<?php

namespace App\Console\Commands\IdeHelper;

use Illuminate\Console\Command;

class AllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all for PhpStorm';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('ide-helper:generate');
        $this->call('ide-helper:meta');
        $this->call('ide-helper:models', ['--nowrite' => true]);
    }
}
