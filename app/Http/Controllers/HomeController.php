<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'games' => Game::query()->get(),
            'title' => 'Home page',
        ]);
    }
}
