<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPHtmlParser\Dom;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Support\Facades\Log;
use xPaw\SourceQuery\SourceQuery;
use Exception;

class ParseServers extends Command
{
    private int $timeout = 3;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all servers from myarena.ru';

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
        $arrGames = [
            '10' => '1',
            '22' => '2',
            '50' => '3',
            '71' => '4',
            '65' => '7',
            '81' => '10',
            '77' => '15',
        ];

        foreach ($arrGames as $mod => $gameId) {

            $addedServers = 0;
            $notAdded = 0;
            for ($iPage = 1; ; $iPage++) {
                $dom = new Dom;
                $dom->loadFromUrl("https://www.myarena.ru/monitoring.html?page_n=$iPage&mod=$mod");
                $a = $dom->find('a');

                $iString = 0;
                foreach ($a as $aElement) {
                    if (preg_match('~\b([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}):([0-9]{1,5}\b)~', $aElement->text, $matches)) {
                        $iString++;
                        $ip = $matches[1];
                        $port = $matches[2];
                        $game = Game::find($gameId);

                        $duplServer = Server::query()->where([
                            ['game_id', $gameId],
                            ['ip', $ip],
                            ['port', $game->getQueryPort($port)]
                        ])->get();

                        if (empty($duplServer[0])) {
                            $Query = new SourceQuery();
                            try {
                                $Query->Connect($ip, $game->getQueryPort($port), $this->timeout, $game->getQueryEngine());

                                $arrInfo = $Query->GetInfo();

                                $server = new Server();
                                $server->game_id = $gameId;
                                $server->ip = $ip;
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
                                $addedServers++;
                            } catch (Exception $e) {
                                $notAdded++;
                            } finally {
                                $Query->Disconnect();
                            }
                        } else {
                            $notAdded++;
                        }
                    }
                }
                if ($iString < 6) {
                    $countServers = $notAdded + $addedServers;
                    $result = "Added $addedServers / $countServers servers for $game->name";
                    $this->info($result);
                    Log::channel('parselog')->info($result);
                    break;
                }
            }

        }

        return 0;
    }
}
