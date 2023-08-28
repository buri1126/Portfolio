<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>2 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>3 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>4 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>5 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>6 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>7 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>8 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>9 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>13 ,
                'follower_id' =>10 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>1 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>2 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>3 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>4 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>5 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>6 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>7 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>8 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>9 ,
                'follower_id' =>13 ,
         ]);
        DB::table('followers')->insert([
                
                'user_id' =>10 ,
                'follower_id' =>13 ,
         ]);
        
    }
}
