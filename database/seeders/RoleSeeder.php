<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'Super Admin',
            'Admin',
            'Manager',
            'User'
        ];
        for ($i = 0; $i < 4; $i++) {
            Role::create([
                'name' => $role[$i],
            ]);
        }
    }
}
