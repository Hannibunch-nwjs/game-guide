<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('games')->insert([
            [
                'title' => 'Minecraft',
                'genre' => 'Sandbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Stardew Valley',
                'genre' => 'Farming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Terraria',
                'genre' => 'Adventure',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}