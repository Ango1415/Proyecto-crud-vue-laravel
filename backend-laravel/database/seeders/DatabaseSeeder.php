<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Genre::create([
            'genre_name' => 'Masculine'
        ]);
        Genre::create([
            'genre_name' => 'Femenine'
        ]);

        User::create([
            'name' => 'Test User',
            'id_card_number'=> '123456789',
            'age' => 23,
            'genre'=> 1,
            'email' => 'test@example.com',
         ]);

         Product::create([
            'name' => 'Personal Computer',
            'bar_code'=> 'ABCD456',
            'price' => 5000,
            'user'=> 1,
         ]);
    }
}
