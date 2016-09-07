<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Eloquent::unguard();

          if (App::environment() === 'production')
          {
            $this->call(RoleTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
          }
          else
          {
            $this->call(RoleTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
          }
    }
}
