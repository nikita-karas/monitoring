<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'games' => Game::query()->get(),
            'servers' => Server::with('game')->get(),
            'title' => 'Home page',
        ]);
    }
}
