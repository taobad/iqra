<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedsUsersRolesCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*$adminpassword = bcrypt('taobad');
      $users = array(
        array('name' => 'Admin','email' => 'admin@iqracollege.net', 'password' => $adminpassword),
      );
      DB::table('users')->insert($users);

      $roles = array(
        array('name' => 'Admin' ,'description' => 'An administrator user'),
        array('name' => 'User','description' => 'A normal user'),
      );
      DB::table('roles')->insert($roles);

      $categories = array(
        array('name' => 'Awards'),
        array('name' => 'Events'),
        array('name' => 'News'),
      );
      DB::table('categories')->insert($categories);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
