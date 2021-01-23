<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile')->with([
            'title' => 'Profile',
        ]);
    }

    public function changeToken()
    {
        $date = Carbon::parse(Auth::user()['api_token_created_at']);
        $now = Carbon::now();
        if ($date->diffInDays($now) < 1){
            return back()->withErrors(['error' => 'You can create a new token only once every 24 hours']);
        }

        $user = User::find(['id']);
        $user->api_token = Str::random(80);
        $user->api_token_created_at = now();
        $user->save();
        return back()->with('status', 'New token created');
    }

    public function destroyServer(Request $request)
    {
        $server = Server::find($request->id);
        if(!$server || !$server->user_id || $server->user_id !== Auth::user()['id']){
            return response()->json('Access is denied', 403);
        }

        $server->delete();
        return back()->with('status', "Server {$server->name} removed");
    }
}
