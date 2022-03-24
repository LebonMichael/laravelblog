<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert(['name' => 'Sport']);
        DB::table('categories')->insert(['name' => 'News']);
        DB::table('categories')->insert(['name' => 'Politiek']);

        $categories = Category::all();
        Post::all()->each(function ($post) use ($categories)
        {
            $post->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
