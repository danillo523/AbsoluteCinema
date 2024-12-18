<?php

namespace App\Console\Commands;

use App\Models\Dvd;
use Illuminate\Console\Command;

class IncrementRentalPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IncrementRentalPrice:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment the rental price of all DVDs by 0.20';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DVD::query()->increment('rental_price', 0.20);
        $this->info('Rental prices incremented by 0.20');
    }
}
