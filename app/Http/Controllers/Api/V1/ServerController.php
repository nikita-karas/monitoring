<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Server;
use xPaw\SourceQuery\SourceQuery;
use Exception;
use Illuminate\Support\Facades\Log;

class ServerController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'game_id' => 'required|exists:App\Models\Game,id',
                'user_id' => 'required|exists:App\Models\User,id',
                'ip' => 'required|ip',
                'port' => 'required|integer',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Check required fields:', '1' => 'game_id', 'ip', 'port'], 400);
        }

        $port = $validated['port'];
        $game = Game::find($validated['game_id']);

        $duplServer = Server::query()->where([
            ['ip', $validated['ip']],
            ['port', $game->getQueryPort($port)]
        ])->get();

        if (!empty($duplServer[0])) {
            return response()->json('This server exists');
        }

        $Query = new SourceQuery();
        try {
            $Query->Connect($validated['ip'], $game->getQueryPort($port), 1, $game->getQueryEngine());

            $arrInfo = $Query->GetInfo();

            $server = new Server();
            $server->game_id = $validated['game_id'];
            $server->ip = $validated['ip'];
            $server->port = $game->getQueryPort($port);
            $server->name = $arrInfo['HostName'];
            $server->players = $arrInfo['Players'];
            $server->max_players = $arrInfo['MaxPlayers'];
            $server->map = $arrInfo['Map'];
            $server->online = true;
            $server->password = $arrInfo['Password'];
            $server->secure = $arrInfo['Secure'];
            $server->fail_attempts = 0;
            $server->user_id = $validated['user_id'];
            $server->save();
            $result = "Server added:
Game - {$game->name} | Name - '{$arrInfo['HostName']}' | IP:PORT - {$validated['ip']}:{$game->getQueryPort($port)}";
            Log::channel('addlog')->info($result);
            return response()->json('Server added successfully');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        } finally {
            $Query->Disconnect();
        }
    }

    public function read(int $id)
    {
        $server = Server::find($id);
        if (!$server) {
            return response()->json('Server not found', 404);
        }
        return response()->json($server->toArray());
    }

    public function update(Request $request, int $id)
    {
        $server = Server::find($id);
        if (!$server) {
            return response()->json('Server not found', 404);
        }
        $request->request->remove('id');
        $request->request->remove('user_id');

        try {
            $server->fill($request->all());
            $server->save();
            return response()->json('Server data updated successfully');
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }


    public function delete(int $id)
    {
        $server = Server::find($id);
        if (!$server) {
            return response()->json('Server not found', 404);
        }
        $server->delete();
        return response()->json('Server successfully removed');
    }

    public function search(Request $request)
    {
        try {
            $validated = $request->validate([
                'game_id' => 'exists:App\Models\Game,id',
                'ip' => 'ip',
                'port' => 'integer',
                'name' => 'string',
                'players' => 'integer',
                'max_players' => 'integer',
                'map' => 'string',
                'online' => 'boolean',
                'secure' => 'boolean',
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        if (!$validated) {
            return response()->json([
                'error' => 'Search term is empty',
                'Check fields' => ['1' => 'game_id', 'ip', 'port', 'name', 'ip', 'players', 'max_players', 'map', 'online', 'secure']
            ], 400);
        }

        foreach ($validated as $column => $value) {
            if (!$value) {
                unset($column);
            }

            switch ($column) {
                case 'game_id':
                case 'ip':
                case 'port':
                case 'online':
                case 'secure':
                    $paramSets[] = [$column, $value];
                    break;
                case 'name':
                case 'map':
                    $paramSets[] = [$column, 'LIKE', "%{$value}%"];
                    break;
                case 'players':
                case 'max_players':
                    $paramSets[] = [$column, '>=', $value];
                    break;
            }
        }

        $servers = Server::where($paramSets)->paginate(100);
        if (!$servers[0]) {
            return response()->json('Server not found', 404);
        }

        return response()->json($servers);
    }
}
