<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('pages.profile')->with([
                'title' => 'Profile',
                'servers' => Server::with('game')
                    ->where('user_id', Auth::user()['id'])
                    ->orderBy('created_at', 'ASC')
                    ->paginate(10),
            ]);
        } else {
            return redirect('/auth/login');
        }
    }
}
