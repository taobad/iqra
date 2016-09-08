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

      $role_user1 = new Role();
      $role_user1->name = 'admin';
      $role_user1->display_name = 'Administrator User';
      $role_user1->description = 'An administrator user';
      $role_user1->save();

      $role_user2 = new Role();
      $role_user2->name = 'student';
      $role_user2->display_name = 'Student User';
      $role_user2->description = 'A Student in the school';
      $role_user2->save();

      $role_user3 = new Role();
      $role_user3->name = 'staff';
      $role_user3->display_name = 'Staff User';
      $role_user3->description = 'A Staff in the school';
      $role_user3->save();

      $role_user4 = new Role();
      $role_user4->name = 'alumni';
      $role_user4->display_name = 'Alumni User';
      $role_user4->description = 'Graduates from the school';
      $role_user4->save();

      $role_user5 = new Role();
      $role_user5->name = 'parent';
      $role_user5->display_name = 'Parent User';
      $role_user5->description = 'Parent or Guardian of a student in the school';
      $role_user5->save();
    }
}
