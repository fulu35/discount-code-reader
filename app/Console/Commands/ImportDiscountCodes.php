<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use App\Services\DiscountCodeService;
use App\Jobs\ImportDiscountCodesJob;
use App\Services\DiscountCodeService;
use Illuminate\Support\Facades\Storage;
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

        $fileSize = Storage::size('public/'.$fileName);
       
        $totalLines = substr_count($file, PHP_EOL);
 
        $chunkSize = 1;
        $totalChunks = ceil($totalLines / $chunkSize);

        $bar = $this->output->createProgressBar($totalChunks);

        for ($i = 0; $i < $totalLines; $i += $chunkSize) {
            $chunk = array_slice($codes, $i, $chunkSize);
            foreach ($chunk as $code) {
                $data = [
                    'code' => trim($code),
                    'campaign_id' => 1 // It is a sybolic campaign_id
                ];
                try {
                    ImportDiscountCodesJob::dispatch($data);
                } catch(\Exception $e) {
                   \Log::error($e->getMessage());
                }
            }
            $bar->advance();
        }
        $bar->finish();

        $this->info('Discount codes import job created successfully.');

        // foreach ($codes as $code) {
        //     $data = [
        //         'code' => trim($code),
        //         'campaign_id' => 1 // It is a sybolic campaign_id
        //     ];
        //     try {
        //         ImportDiscountCodesJob::dispatch($data)->delay(3);
        //     } catch(\Exception $e) {
        //         dd($e);
        //     }
        // }
        // $this->info('Discount codes import job created successfully.');
    }
}