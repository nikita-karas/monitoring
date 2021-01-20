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
        $server = Server::with('user')->find($id);

        if ($server) {
            $timeUpdate = $server->updated_at;
            $Query = new SourceQuery();
            try {
                $Query->Connect($server->ip, $server->port, 3, $server->game->getQueryEngine());

                $players = $Query->GetPlayers();
            } catch (Exception $e) {

            } finally {
                $Query->Disconnect();
            }

            $title = 'Server page';
            $time = Carbon::now()->parse($timeUpdate)->diffInMinutes();
            if (!empty($players)) {
                return view('pages.server', compact('title', 'server', 'players', 'time'));
            }
            return view('pages.server', compact('title', 'server', 'time'));
        }
        return view('errors.404');
    }
}
