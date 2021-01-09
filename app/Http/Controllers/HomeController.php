<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'servers' => Server::with('game')->Paginate(50),
            'title' => 'Home page',
        ]);
    }

    public function search(Request $request)
    {
        $s = $request->s;
        $servers = Server::with('game')->where('name', 'LIKE', "%{$s}%")->orderBy('name')->paginate(10);
        return view('index')->with([
            'servers' => $servers,
            'title' => 'Home page',
        ]);
    }

}
