<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Game;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GuideController;


Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Display the games list.
Route::get('/games/{game}/guides/create', [GuideController::class, 'create'])
    ->middleware('auth')
    ->whereNumber('game')
    ->name('guides.create');

Route::post('/games/{game}/guides', [GuideController::class, 'store'])
    ->middleware('auth')
    ->whereNumber('game')
    ->name('guides.store');

Route::get('/games', function () {
    return Inertia::render('Games/Index', [
        'games' => Game::orderBy('id')->get(),
    ]);
});
Route::get('/games/create', [GameController::class, 'create'])
    ->name('games.create');

Route::post('/games', [GameController::class, 'store'])
    ->name('games.store');

    Route::get('/guides/{guide}/edit', [GuideController::class, 'edit'])
    ->middleware('auth')
    ->whereNumber('guide')
    ->name('guides.edit');

Route::put('/guides/{guide}', [GuideController::class, 'update'])
    ->middleware('auth')
    ->whereNumber('guide')
    ->name('guides.update');
// Display the selected game's guide.
Route::get('/games/{id}', function (string $id) {
    $game = Game::findOrFail($id);

    $allGuides = $game->guides()
        ->orderBy('id')
        ->get()
        ->map(function ($guide) {
            return [
                'id' => (string) $guide->id,
                'title' => $guide->title,
                'steps' => $guide->steps,
            ];
        })
        ->all();

    return Inertia::render('Games/Show', [
        'game' => [
            'id' => $game->id,
            'title' => $game->title,
        ],
        'guides' => $allGuides,
    ]);
})->whereNumber('id');