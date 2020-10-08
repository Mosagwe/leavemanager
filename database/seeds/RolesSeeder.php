<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    protected $roles = [
        ['name' => 'Administrator'],
        ['name' => 'Head of Department'],
        ['name' => 'User'],
        ['name' => 'Line Manager'],
        ['name' => 'HR Manager'],
        ['name' => 'Approver']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::create($role);
        }
    }
}
