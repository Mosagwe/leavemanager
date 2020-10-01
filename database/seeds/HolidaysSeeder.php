<?php

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HolidaysSeeder extends Seeder
{
    protected $holidays = [
        //['name' => 'Mashujaa Day', 'date' => '2020-10-10', 'is_annual' => true]
        ['name' => 'New Year', 'date' => '2020-01-01', 'is_annual' => true],
        ['name' => 'Labour Day', 'date' => '2020-05-01', 'is_annual' => true],
        ['name' => 'Madaraka Day', 'date' => '2020-06-01', 'is_annual' => true],
        ['name' => 'Huduma Day', 'date' => '2020-10-10', 'is_annual' => true],
        ['name' => 'Mashujaa Day', 'date' => '2020-10-20', 'is_annual' => true],
        ['name' => 'Jamhuri Day', 'date' => '2020-12-12', 'is_annual' => true],
        ['name' => 'Christmas Day', 'date' => '2020-12-25', 'is_annual' => true],
        ['name' => 'Mashujaa Day', 'date' => '2020-12-26', 'is_annual' => true]

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
