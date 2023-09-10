<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>1 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>2 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>3 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>4 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>5 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>6 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>7 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>8 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>9 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>10 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>1 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>2 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>3 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>4 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>5 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>6 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>7 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>8 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>9 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>10 ,
                'follower_id' =>13 ,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        
    }
}
