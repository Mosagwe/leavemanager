<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HolidaysSeeder::class);
        $this->call(EmploymentTypesSeeder::class);
        $this->call(LeaveTypesSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
