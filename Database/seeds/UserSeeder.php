<?php

namespace Mohsen\User\Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohsen\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'محسن مرادی',
            'email' => 'admin@gmail.com',
            'mobile' => '9902460858',
            'email_verified_at' => Carbon::now()->subDays(3),
            'password' => bcrypt(123),
            'status' => 'active',
            'username' => Str::random(10)
        ]);
        $user2 = User::create([
            'name' => 'مجید مرادی',
            'email' => 'teacher@gmail.com',
            'mobile' => '9365268578',
            'email_verified_at' => Carbon::now()->subDays(3),
            'password' => bcrypt(123),
            'status' => 'active',
            'username' => Str::random(10),
            'balance'=>random_int(5000,500000)
        ]);

        $user3 = User::create([
            'name' => 'دانش آموز',
            'email' => 'student@gmail.com',
            'mobile' => '9365268571',
            'email_verified_at' => Carbon::now()->subDays(3),
            'password' => bcrypt(123),
            'status' => 'active',
            'username' => Str::random(10)
        ]);
        User::factory(30)->create();
        User::factory(10)->create()->each(function ($new_user) {
            $new_user->assignRole(\Mohsen\RolePermissions\Models\Role::ROLE_TEACHER);
        });
        $user->givePermissionTo(\Mohsen\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN);
        $user2->assignRole(\Mohsen\RolePermissions\Models\Role::ROLE_TEACHER);
    }
}
