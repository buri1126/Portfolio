<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
             'name' => '---',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Arsenal',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Aston Villa',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Bournemouth',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Brentford',
            
             ]);
        DB::table('teams')->insert([
             'name' => 'Brighton',
             
             ]);
         DB::table('teams')->insert([
         'name' => 'Burnley',
         
         ]);
        DB::table('teams')->insert([
             'name' => 'Chelsea',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Crystal Palace',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Everton',
             
             ]);
        DB::table('teams')->insert([
            'name' => 'Fulham',
             
             ]);
      
       
        DB::table('teams')->insert([
             'name' => 'Liverpool',
             
             ]);
          DB::table('teams')->insert([
         'name' => 'Luton',
         
         ]);
        DB::table('teams')->insert([
             'name' => 'Manchester City',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Manchester United',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Newcastle',
            
             ]);
       DB::table('teams')->insert([
             'name' => 'Nottingham Forest',
             
             ]);
        DB::table('teams')->insert([
              'name' => 'Sheffield Utd',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'Tottenham',
             
             ]);
        DB::table('teams')->insert([
             'name' => 'West Ham',
            
             ]);
        DB::table('teams')->insert([
             'name' => 'Wolves',
             
             ]);

    }
}
