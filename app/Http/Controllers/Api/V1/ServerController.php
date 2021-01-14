<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Exception;

class ServerController extends Controller
{
    public function create()
    {

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


    public function delete()
    {

    }
}
