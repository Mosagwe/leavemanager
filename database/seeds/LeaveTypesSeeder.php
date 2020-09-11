<?php

use App\Models\EmploymentType;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypesSeeder extends Seeder
{
    protected $leaveTypes = [
        ['name' => 'Annual Leave', 'maximum_days' => 30, 'carry_over_days' => 15, 'gender' => 'All', 'can_use_partially' => 1]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employmentTypeId = EmploymentType::whereName('Full Time')->first()->id;

        foreach ($this->leaveTypes as $leaveType) {
            $leaveType = LeaveType::create($leaveType);
            $leaveType->employmentTypes()->attach([$employmentTypeId]);
        }
    }
}
