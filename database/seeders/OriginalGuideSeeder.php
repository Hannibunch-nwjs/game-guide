<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Guide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginalGuideSeeder extends Seeder
{
    public function run(): void
    {
        $originalGuides = [
            1 => [
                'title' => 'Beginner Survival Guide',
                'steps' => [
                    'Gather wood from trees.',
                    'Craft a crafting table.',
                    'Make basic tools.',
                    'find sheep and slay it',
                    'Build a shelter before night.',
                ],
            ],
            2 => [
                'title' => 'Starting Your Farm',
                'steps' => [
                    'Clear a small area on your farm.',
                    'Prepare the soil with your hoe.',
                    'Plant your starting seeds.',
                    'Water your crops.',
                ],
            ],
            3 => [
                'title' => 'Getting Started',
                'steps' => [
                    'Gather wood.',
                    'Craft a workbench.',
                    'Build a basic shelter.',
                    'Explore nearby caves for resources.',
                ],
            ],
        ];

        DB::transaction(function () use ($originalGuides) {
            foreach ($originalGuides as $gameId => $data) {
                $game = Game::findOrFail($gameId);

                $exists = $game->guides()
                    ->where('title', $data['title'])
                    ->exists();

                if (! $exists) {
                    $guide = new Guide();
                    $guide->title = $data['title'];
                    $guide->steps = $data['steps'];

                    $game->guides()->save($guide);
                }
            }
        });
    }
}