<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function create()
    {

    }

    public function read(int $id)
    {
        $server = Server::find($id);
        if($server) {
            return response()->json([
                'data' => $server->toArray(),
            ]);
        } else {
            return response()->json([
                'error' => 'Server not found',
            ], 404);
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
