<?php

namespace App\Http\Controllers;

use App\Models\Server;
use xPaw\SourceQuery\SourceQuery;
use Exception;
use Carbon\Carbon;

class ServerController extends Controller
{
    public function index($slug, $id)
    {
        $server = Server::find($id);

        if ($server) {
            $timeUpdate = $server->updated_at;

            $Query = new SourceQuery();
            try {
                $Query->Connect($server->ip, $server->port, 3, $server->game->getQueryEngine());

                $players = $Query->GetPlayers();
                if (empty($players)){
                    $players = 'Server is empty';
                }
            } catch (Exception $e) {
                $players = 'Server connection error';
            } finally {
                $Query->Disconnect();
            }

            return view('pages.server')->with([
                'title' => 'Server page',
                'server' => $server,
                'players' => $players,
                'time' => Carbon::now()->parse($timeUpdate)->diffInMinutes(),
            ]);
        } else {
            return view('errors.404');
        }
    }
}
