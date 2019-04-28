<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();

        $admin = new User();
        $admin->firstname = 'Admin';
        $admin->lastname = 'iqracollege';
        $admin->email = 'admin@iqracollege.net';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->attachRole($role_user);
        $admin->attachRole($role_admin);
    }
}
