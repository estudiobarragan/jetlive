<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert(['name' => 'Peronismo']);
        DB::table('tags')->insert(['name' => 'Astronomia']);
        DB::table('tags')->insert(['name' => 'Fisica']);
        DB::table('tags')->insert(['name' => 'Filosofia']);
        DB::table('tags')->insert(['name' => 'Pelotudeando']);
        DB::table('tags')->insert(['name' => 'Quimica']);
        DB::table('tags')->insert(['name' => 'Matematica']);
        DB::table('tags')->insert(['name' => 'Historia']);
        DB::table('tags')->insert(['name' => 'Religion']);
        DB::table('tags')->insert(['name' => 'Inspiracion']);
    }
}
