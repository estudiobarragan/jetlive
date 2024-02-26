<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\User::factory()->create([
            'name' => 'jmb',
            'email' => 'jmb@jmb.com.ar',
            'password'=> Hash::make('123'),
        ]);
        
        \App\Models\User::factory(19)
                        ->create();
                        // ->has(Post::factory()->count(3))
    }
}
