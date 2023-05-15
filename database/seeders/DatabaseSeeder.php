<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Post::factory(1)->create([
            'id' => 1,
            'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quibusdam, labore modi iusto similique eaque fugit beatae consequatur? Dignissimos, repellendus?'
        ]);
    }
}
