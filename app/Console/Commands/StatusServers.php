<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Server;
use Exception;
use xPaw\SourceQuery\SourceQuery;

class StatusServers extends Command
{
    private int $timeout = 3;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status all servers in DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = now();
        $Query = new SourceQuery();
        $countServers = 0;
        $updatedServers = 0;

        $data = Server::with('game')->get();
        foreach ($data as $server) {

            $port = $server['port'];
            $engine = SourceQuery::SOURCE;
            switch ($server->game['app_id']) {
                case 10:
                    $engine = SourceQuery::GOLDSOURCE;
                    break;
                /**
                 * If the game has appID = 107410 || 244850 – need to add +1 to the server port.
                 *
                 * https://github.com/xPaw/PHP-Source-Query#supported-games
                 */
                case 107410:
                case 244850:
                    $port++;
                    break;
            }

            try {
                $Query->Connect($server['ip'], $port, $this->timeout, $engine);

                $arrInfo = $Query->GetInfo();

                Server::query()->where('id', $server['id'])
                    ->update([
                        'name' => $arrInfo['HostName'],
                        'players' => $arrInfo['Players'],
                        'max_players' => $arrInfo['MaxPlayers'],
                        'map' => $arrInfo['Map'],
                        'online' => true,
                        'password' => $arrInfo['Password'],
                        'secure' => $arrInfo['Secure'],
                    ]);
                $updatedServers++;
            } catch (Exception $e) {
                Server::query()->where('id', $server['id'])
                    ->update(['online' => false, 'fail_attempts' => $server['fail_attempts'] + 1]);
            } finally {
                $Query->Disconnect();
            }

            $countServers++;
        }
        $time = $start->diffInSeconds(now());
        $result = "Updated servers: $updatedServers/$countServers
Time spent: $time seconds";
        $this->info($result);
        Log::channel('statuslog')->info($result);
        return 0;
    }
}
