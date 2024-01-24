<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckEnvCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $databaseConfig = config('database.connections.mysql');

        if (empty($databaseConfig['host'])) {
            $this->error('Error: Database host not configured in .env');
        } else {
            $this->info('Success: .env configuration is valid');
        }
    }
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-env-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



}
