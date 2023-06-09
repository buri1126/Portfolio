<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
             'name' => 'preview',
        ]);
        DB::table('categories')->insert([
             'name' => 'review',
        ]);
        DB::table('categories')->insert([
             'name' => 'transfer',
        ]);
        DB::table('categories')->insert([
             'name' => 'other',
        ]);

}
