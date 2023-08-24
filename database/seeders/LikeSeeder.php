<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 2,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 3,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 4,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 5,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 6,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 7,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 8,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 9,
                'post_id' =>10,
         ]);
          DB::table('likes')->insert([
                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 10,
                'post_id' =>10,
         ]);
    }
}
