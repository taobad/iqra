<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->display_name = 'User';
        $role_user->description = 'All user belongs to this category or role';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'Admin';
        $role_user->display_name = 'Administrator User'
        $role_user->description = 'An administrator user';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'student';
        $role_user->display_name = 'Student User';
        $role_user->description = 'A Student in the school';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'staff';
        $role_user->display_name = 'Staff User'
        $role_user->description = 'A Staff in the school';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'alumni';
        $role_user->display_name = 'Alumni User';
        $role_user->description = 'Graduates from the school';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'parent';
        $role_user->display_name = 'Parent User';
        $role_user->description = 'Parent or Guardian of a student in the school';
        $role_user->save();
    }
}
