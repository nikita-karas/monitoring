<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Support\Facades\Log;
use xPaw\SourceQuery\SourceQuery;
use Exception;

class ServerController extends Controller
{
    private int $timeout = 3;

    public function index()
    {
        if (Auth::check()) {
            return view('pages.server')->with([
                'title' => 'Add server',
            ]);
        } else {
            return redirect('/auth/login');
        }
    }

    public function addServer(Request $request)
    {
        $validator = $request->validate([
            'game' => 'exists:App\Models\Game,id',
            'ip' => 'required|ip',
            'port' => 'required|integer',
        ]);

        $port = $validator['port'];
        $game = Game::find($validator['game']);

        $duplServer = Server::query()->where([
            ['ip', $validator['ip']],
            ['port', $game->getQueryPort($port)]
        ])->get();

        if (!empty($duplServer[0])) {
            return back()->withErrors(["server_error" => "The server already exists in the database."]);
        }

        $Query = new SourceQuery();
        try {
            $Query->Connect($validator['ip'], $game->getQueryPort($port), $this->timeout, $game->getQueryEngine());

            $arrInfo = $Query->GetInfo();

            $server = new Server();
            $server->game_id = $validator['game'];
            $server->ip = $validator['ip'];
            $server->port = $game->getQueryPort($port);
            $server->name = $arrInfo['HostName'];
            $server->players = $arrInfo['Players'];
            $server->max_players = $arrInfo['MaxPlayers'];
            $server->map = $arrInfo['Map'];
            $server->online = true;
            $server->password = $arrInfo['Password'];
            $server->secure = $arrInfo['Secure'];
            $server->fail_attempts = 0;
            $server->save();
            $result = "Server added:
Game - {$game->name} | Name - '{$arrInfo['HostName']}' | IP:PORT - {$validator['ip']}:{$game->getQueryPort($port)}";
            Log::channel('addlog')->info($result);
            return back()->with('status', 'Server added successfully!');
        } catch (Exception $e) {
            return back()->withErrors(["server_error" => "{$e->getMessage()}."]);
        } finally {
            $Query->Disconnect();
        }

    }
}
