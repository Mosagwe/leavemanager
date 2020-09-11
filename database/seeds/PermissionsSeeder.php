<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    protected $permissions = [
        ['name' => 'View Approved Requests'],
        ['name' => 'Recommend Leave Requests'],
        ['name' => 'Approve Leave Requests'],

        ['name' => 'View Employees'],
        ['name' => 'Create Employees'],
        ['name' => 'Deactivate Employees'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }
    }
}
