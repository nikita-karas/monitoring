<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;

class GameController extends Controller
{
    public function index($slug)
    {
        $gameName = Game::query()->where('url', $slug)->value('name');
        if ($gameName) {
            return view('pages.game')->with([
                'slug' => $slug,
                'servers' => Server::whereHas('game', function ($query) use ($slug) {
                    return $query->where('url', $slug);
                })->get(),
                'title' => "$gameName Servers",
            ]);
        } else {
            return view('errors.404');
        }
    }

}
