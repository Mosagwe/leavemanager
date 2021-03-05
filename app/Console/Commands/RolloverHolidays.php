<?php

namespace App\Console\Commands;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RolloverHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:rollover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollover yearly holidays to the next year.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Updating Holidays '.Carbon::now());
        Holiday::chunk(1000, function ($holidays) {
            foreach ($holidays as $holiday) {
                if ($holiday->is_annual) {
                    $holiday->date =(new Carbon( $holiday->date))->addYear();
                    $holiday->save();
                }
            }
        });
        $this->info('Holidays updated '.Carbon::now());
    }
}
