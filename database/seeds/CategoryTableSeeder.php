<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Awards';
        $category->save();

        $category = new Category();
        $category->name = 'Events';
        $category->save();

        $category = new Category();
        $category->name = 'News';
        $category->save();
    }
}
