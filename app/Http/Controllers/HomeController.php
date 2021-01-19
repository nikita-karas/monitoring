<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'servers' => Server::with('game')->orderByRaw("online DESC, players DESC")->Paginate(50),
            'title' => 'Home page',
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->s;

        $servers = Server::with('game')
            ->where('name', 'LIKE', "%{$search}%")
            ->orderBy('players', 'DESC')
            ->paginate(50);

        return view('index')->with([
            'search' => $search,
            'servers' => $servers,
            'title' => 'Home page',
        ]);
    }

}
