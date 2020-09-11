<?php

use App\Models\EmploymentType;
use Illuminate\Database\Seeder;

class EmploymentTypesSeeder extends Seeder
{
    protected $employmentTypes = [
        ['name' => 'Full Time', 'description' => 'Permanent and pensionable']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->employmentTypes as $employmentType) {
            EmploymentType::create($employmentType);
        }
    }
}
