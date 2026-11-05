<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function create()
    {
        return Inertia::render('Games/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'image' =>[
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ]
        ]);

        $game = new Game();
        $game->title = $validated['title'];
        $game->genre = $validated['genre'];

        if($request->hasFile('image')){
            $game ->image_path = $request 
            ->file('image')
            ->store('games', 'public');
        }
        $game->save();

        return redirect('/games');
    }
}