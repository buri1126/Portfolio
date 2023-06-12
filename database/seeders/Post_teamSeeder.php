<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Post_teamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_team')->insert([
              'post_id' => 1,
              'team_id' => 2,
         ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 2,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 3,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 4,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 5,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 6,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 7,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 8,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 9,
        //      'team_id' => 1,
        // ]);
        // DB::table('post_team')->insert([
        //      'post_id' => 10,
        //      'team_id' => 1,
        // ]);
    }
}
