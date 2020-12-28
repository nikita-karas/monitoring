<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Server;
use xPaw\SourceQuery\SourceQuery;
use Exception;

class ServerController extends Controller
{
    private int $timeout = 3;

    private int $engine = SourceQuery::SOURCE;

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('server', compact('user'));
        } else {
            return redirect('/auth/login');
        }
    }

    public function addServer(Request $request)
    {
        $validator = $request->validate([
            'game' => 'required|string',
            'ip' => 'required|ip',
            'port' => 'required|integer',
        ]);

        $port = $validator['port'];
        switch ($validator['game']) {
            case 'Counter-Strike 1.6':
                $this->engine = SourceQuery::GOLDSOURCE;
                break;
            case 'Arma 3':
            case 'Space Engineers':
                $port++;
                break;
        }

        $Query = new SourceQuery();

        try {
            $Query->Connect($validator['ip'], $port, $this->timeout, $this->engine);

            $arrInfo = $Query->GetInfo();

            $game = Game::query()->where('url', $arrInfo['ModDir'])->value('id');

            $server = new Server();
            $server->game_id = $game;
            $server->ip = $validator['ip'];
            $server->port = $port;
            $server->name = $arrInfo['HostName'];
            $server->players = $arrInfo['Players'];
            $server->max_players = $arrInfo['MaxPlayers'];
            $server->map = $arrInfo['Map'];
            $server->online = true;
            $server->password = $arrInfo['Password'];
            $server->secure = $arrInfo['Secure'];
            $server->fail_attempts = 0;
            $server->save();
            return back()->with('status', 'Server added successfully!');
        } catch (Exception $e) {
            return back()->withErrors(["server_error"=>"{$e->getMessage()}."]);
        } finally {
            $Query->Disconnect();
        }

    }
}
