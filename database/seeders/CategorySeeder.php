<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(['name' => 'Ciencia']);
        DB::table('categories')->insert(['name' => 'Biologia']);
        DB::table('categories')->insert(['name' => 'Inspiracion']);
        DB::table('categories')->insert(['name' => 'Politica']);
        DB::table('categories')->insert(['name' => 'Miscelaneos']);
    }
}
