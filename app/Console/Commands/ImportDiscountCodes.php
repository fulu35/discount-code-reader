<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportDiscountCodesJob;
use Illuminate\Support\Facades\Storage;
use App\Models\Campaign;
class ImportDiscountCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:discount-codes {filename}'; //  php artisan import:discount-codes discount_codes.csv

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    
    public function handle(): void
    {

        $fileName = $this->argument('filename');
        $file = Storage::get('public/'.$fileName);

        $codes = explode(PHP_EOL, $file);
       
        $totalLines = substr_count($file, PHP_EOL);
 
        $chunkSize = 1;
        $totalChunks = ceil($totalLines / $chunkSize);

        $bar = $this->output->createProgressBar($totalChunks);
        for ($i = 0; $i < $totalLines; $i += $chunkSize) {
            $campaign =  Campaign::inRandomOrder()->first(); // random campaign
            $campaign_id =  $campaign ? $campaign->id :1;
         
            $chunk = array_slice($codes, $i, $chunkSize);
            foreach ($chunk as $code) {
                $data = [
                    'code' => trim($code),
                    'campaign_id' =>$campaign_id
                ];
                try {
                    ImportDiscountCodesJob::dispatch($data)->delay(now()->addSeconds(30));
                } catch(\Exception $e) {
                   \Log::error($e->getMessage());
                }
            }
            $bar->advance();
        }
        $bar->finish();

        $this->info('Discount codes import job created successfully.');
    }
}