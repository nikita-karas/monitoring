<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;

class MainController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'games' => Game::query()->get(),
            'servers' => Server::with('game')->get(),
            'title' => 'Home page',
        ]);
    }

    public function showGamePage($slug)
    {
        $gameName = Game::query()->where('url', $slug)->value('name');
        if ($gameName) {
            return view('index')->with([
                'slug' => $slug,
                'games' => Game::query()->get(),
                'servers' => Server::whereHas('game', function ($query) use ($slug) {
                    return $query->where('url', $slug);
                })->get(),
                'title' => $gameName,
            ]);
        } else {
            abort(404);
        }
    }
}
