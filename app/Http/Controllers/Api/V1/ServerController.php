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
        $validated = $request->validate([
            'game_id' => 'exists:App\Models\Game,id',
            'ip' => 'required|ip',
            'port' => 'required|integer',
        ]);

        $port = $validated['port'];
        $game = Game::find($validated['game_id']);

        $duplServer = Server::query()->where([
            ['ip', $validated['ip']],
            ['port', $game->getQueryPort($port)]
        ])->get();

        if (!empty($duplServer[0])) {
            return response()->json([
                'error' => 'The server already exists in the database',
            ], 500);
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
            $server->save();
            $result = "Server added:
Game - {$game->name} | Name - '{$arrInfo['HostName']}' | IP:PORT - {$validated['ip']}:{$game->getQueryPort($port)}";
            Log::channel('addlog')->info($result);
            return response()->json([
                'status' => 'Server added successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        } finally {
            $Query->Disconnect();
        }
    }

    public function read(int $id)
    {
        $server = Server::find($id);
        if ($server) {
            return response()->json([
                'data' => $server->toArray(),
            ]);
        } else {
            return response()->json([
                'error' => 'Server not found',
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $server = Server::find($id);
        if ($server) {
            $request->request->remove('id');
            $request->request->remove('user_id');
            try {
                $server->fill($request->all());
                $server->save();
                return response()->json([
                    'status' => 'Server data updated successfully'
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ], 500);
            }
        } else {
            return response()->json([
                'error' => 'Server not found'
            ], 404);
        }
    }


    public function delete(int $id)
    {
        $server = Server::find($id);
        if($server){
            $server->delete();
            return response()->json([
                'status' => 'Server successfully removed'
            ]);
        } else {
            return response()->json([
                'error' => 'Server successfully removed'
            ]);
        }
    }
}
