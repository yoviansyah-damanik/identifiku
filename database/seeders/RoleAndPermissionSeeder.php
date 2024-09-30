<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Superadmin']);
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'School']);
        Role::create(['name' => 'Student']);
    }
}
