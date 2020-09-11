<?php

use App\Models\Department;
use App\Models\EmploymentType;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Peter Mosagwe',
            'username' => 'mosagwe',
            'email' => 'pmosagwe@hudumakenya.go.ke',
            'password' => bcrypt('password'),
            'gender' => 'Male',
            'change_password' => false,
            'role_id' => Role::whereName('Administrator')->first()->id,
            'employment_type_id' => EmploymentType::whereName('Full Time')->first()->id,
            'department_id' => Department::whereName('ICT')->first()->id
        ]);

        $leaveType = LeaveType::whereName('Annual Leave')->first();

        if ($leaveType) {
            $user->leaveBalances()->create([
                'leave_type_id' => $leaveType->id,
                'balance' => $leaveType->maximum_days,
            ]);
        }
    }
}
