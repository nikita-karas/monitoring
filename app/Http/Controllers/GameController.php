<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;

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
                })->orderBy('online', 'DESC')->orderBy('players', 'DESC')->Paginate(50),
                'title' => "$gameName Servers",
            ]);
        } else {
            return view('errors.404');
        }
    }

    public function search(Request $request, $slug)
    {
        $search = $request->s;
        $gameName = Game::where('url', $slug)->value('name');

        $servers = Server::whereHas('game', function ($q) use ($slug, $search) {
            $q->where('url', $slug);
        })
            ->where('name', 'LIKE', "%{$search}%")
            ->orderBy('players', 'DESC')
            ->paginate(50);

        return view('pages.game')->with([
            'slug' => $slug,
            'search' => $search,
            'servers' => $servers,
            'title' => "$gameName Servers",
        ]);
    }

}
