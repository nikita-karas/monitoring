<?php

namespace App\Http\Controllers;

use App\Models\Server;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'servers' => Server::with('game')->get(),
            'title' => 'Home page',
        ]);
    }

}
