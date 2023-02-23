<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;

class CreateFakeCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:campaigns {count=10}'; //  php artisan make:campaigns

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='Create multiple campaign records using the factory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $count = (int) $this->argument('count');

        if ($count <= 0) {
            $this->error('Count must be a positive integer');
            return;
        }

        Campaign::factory()->count($count)->create();

        $this->info("{$count} campaigns created successfully.");
    }
}
