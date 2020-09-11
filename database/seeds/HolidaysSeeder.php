<?php

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HolidaysSeeder extends Seeder
{
    protected $holidays = [
        ['name' => 'Mashujaa Day', 'date' => '2020-10-10', 'is_annual' => true]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
