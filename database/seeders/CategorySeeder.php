<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //seeders using to insert values in db when call this seeders 
    //how run it ? by 
    //php artisan db:seed fileName 
    //or you can use : php artisan db:seed , thats run all seed that called in DatabaseSeeder
    public function run(): void
    {
        $categories = ['Food','Travel','Financial','Fashion'];
        foreach ($categories as $category) {
            Category::create([
                'name'=>$category
            ]);
        }
    }
}
