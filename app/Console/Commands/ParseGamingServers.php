<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPHtmlParser\Dom;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Support\Facades\Log;
use xPaw\SourceQuery\SourceQuery;
use Exception;

class ParseGamingServers extends Command
{
    private int $timeout = 3;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:gamingservers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all servers from gamingservers.ru';

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
        $Games = [
            'cs16' => 1, // Counter-Strike 1.6
            'teamfortress2' => 2, // Team Fortress 2
            'left4dead2' => 3, // Left 4 Dead 2
            'csgo' => 4, // Counter-Strike: Global Offensive
            'garrysmod' => 7, // Garrys Mod
            'rust' => 15, // Rust
            'ark' => 17, // ARK: Survival Evolved
        ];

        foreach ($Games as $urlG => $gameId) {

            $addedServers = 0;
            $notAddedS = 0;
            for ($iPage = 1; ; $iPage++) {

                $url = "https://gamingservers.ru/{$urlG}/";
                if ($iPage >= 2) {
                    $url .= "?page={$iPage}";
                }
                $dom = new Dom;
                $dom->loadFromUrl($url);
                $html = $dom->outerHtml;
                $tdTags = $dom->loadStr($html)->find('td.a');

                $serversOnPage = 0;
                foreach ($tdTags as $td) {
                    if (preg_match('~\b([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}):([0-9]{1,5}\b)~', $td, $matches)) {
                        $serversOnPage++;
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
                                $notAddedS++;
                            } finally {
                                $Query->Disconnect();
                            }
                        } else {
                            $notAddedS++;
                        }
                    }
                }
                if ($serversOnPage === 0) {
                    $countServers = $addedServers + $notAddedS;
                    $result = "Added $addedServers / $countServers servers for $game->name from gamingservers";
                    $this->info($result);
                    Log::channel('parselog')->info($result);
                    break;
                }

            }

        }

        return 0;
    }
}
