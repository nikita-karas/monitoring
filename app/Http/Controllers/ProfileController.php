<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Server;
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
                'diff' => $diff,
            ]);
        } else {
            return redirect('/auth/login');
        }
    }

    public function changeToken(Request $request)
    {
        if (!$request->diff || $request->diff == 0){
            return back()->withErrors(["error" => "Token update is possible once a day"]);
        }

        $user = User::find($request->user_id);
        $user->api_token = Str::random(80);
        $user->save();
        return back()->with('status', "Token updated");
    }

    public function destroyServer(Request $request)
    {
        $server = Server::find($request->id);
        $server->delete();
        return back()->with('status', "Server {$server->name} removed");
    }
}
