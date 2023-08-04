<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
                'title' => 'title1',
                'body' => 'body1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 1,
         ]);
         DB::table('posts')->insert([
                'title' => 'title2',
                'body' => 'body2',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 2,
         ]);
         DB::table('posts')->insert([
                'title' => 'title3',
                'body' => 'body3',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 3,
         ]);
         DB::table('posts')->insert([
                'title' => 'title4',
                'body' => 'body4',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 4,
         ]);
         DB::table('posts')->insert([
                'title' => 'title5',
                'body' => 'body5',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 5,
         ]);
         DB::table('posts')->insert([
                'title' => 'title6',
                'body' => 'body6',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 6,
         ]);
         DB::table('posts')->insert([
                'title' => 'title7',
                'body' => 'body7',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 7,
         ]);
         DB::table('posts')->insert([
                'title' => 'title8',
                'body' => 'body8',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 8,
         ]);
         DB::table('posts')->insert([
                'title' => 'title9',
                'body' => 'body9',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 10,
         ]);
         DB::table('posts')->insert([
                'title' => 'title10',
                'body' => 'body10',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'category_id' => 1,
                'user_id' => 11,
        ]);

    }
}
