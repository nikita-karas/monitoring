<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GamePageController extends Controller
{
    public function index($slug)
    {
        $game = Game::query()->where('url', $slug)->value('name');
        if ($game) {
            return view('game')->with([
                'slug' => $slug,
                'title' => $game,
            ]);
        } else {
            abort(404);
        }
    }
}
