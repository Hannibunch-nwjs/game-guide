<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Guide;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuideController extends Controller
{
    public function create(Game $game)
    {
        return Inertia::render('Guides/Create', [
            'game' => [
                'id' => $game->id,
                'title' => $game->title,
            ],
        ]);
    }

    public function store(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'steps' => ['required', 'array', 'min:1'],
            'steps.*' => ['required', 'string', 'max:2000'],
        ]);

        $guide = new Guide();
        $guide->title = $validated['title'];
        $guide->steps = $validated['steps'];

        $game->guides()->save($guide);

        return redirect('/games/'.$game->id);
    }
    public function edit(Guide $guide)
{
    return Inertia::render('Guides/Edit', [
        'game' => [
            'id' => $guide->game->id,
            'title' => $guide->game->title,
        ],
        'guide' => [
            'id' => $guide->id,
            'title' => $guide->title,
            'steps' => $guide->steps,
        ],
    ]);
}

public function update(Request $request, Guide $guide)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'steps' => ['required', 'array', 'min:1'],
        'steps.*' => ['required', 'string', 'max:2000'],
    ]);

    $guide->title = $validated['title'];
    $guide->steps = $validated['steps'];
    $guide->save();

    return redirect('/games/'.$guide->game_id);
}
}