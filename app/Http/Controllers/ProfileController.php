<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $date = Carbon::parse(Auth::user()['updated_at']);
            $now = Carbon::now();
            $diff = $date->diffInDays($now);

            return view('pages.profile')->with([
                'title' => 'Profile',
                'user' => Auth::user(),
                'diff' => $diff,
            ]);
        } else {
            return redirect('/auth/login');
        }
    }

    public function changeToken(Request $request)
    {
        $user = User::find($request->id);
        $user->api_token = Str::random(80);
        $user->save();
        return back()->with('status', "Token updated");
    }

    public function destroyServer(Request $request)
    {
        $server = Server::find($request->delete);
        $server->delete();
        return back()->with('status', "Server {$server->name} removed");
    }
}
