<?php

namespace App\Jobs;

use App\Models\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use xPaw\SourceQuery\SourceQuery;
use Exception;

class UpdateServerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $server;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($server)
    {
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Query = new SourceQuery();
        try {
            $Query->Connect($this->server['ip'], $this->server['port'], 1, $this->server->game->getQueryEngine());

            $arrInfo = $Query->GetInfo();

            Server::query()->where('id', $this->server['id'])
                ->update([
                    'name' => $arrInfo['HostName'],
                    'players' => $arrInfo['Players'],
                    'max_players' => $arrInfo['MaxPlayers'],
                    'map' => $arrInfo['Map'],
                    'online' => true,
                    'password' => $arrInfo['Password'],
                    'secure' => $arrInfo['Secure'],
                    'fail_attempts' => 0,
                ]);
        } catch (Exception $e) {
            Server::query()->where('id', $this->server['id'])
                ->update(['online' => false, 'fail_attempts' => $this->server['fail_attempts'] + 1]);
        } finally {
            $Query->Disconnect();
        }
    }
}
