<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'user_name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('googleitis'),
            'phone_number' => '92 *********'
        ]);

        $role = Role::where('name', 'Super Admin')->first();
        $permissions = Permission::all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
