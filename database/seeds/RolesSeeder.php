<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    protected $roles = [
        ['name' => 'Administrator'],
        ['name' => 'Head of Department'],
        ['name' => 'ICT Officer'],
        ['name' => 'CEO']
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
