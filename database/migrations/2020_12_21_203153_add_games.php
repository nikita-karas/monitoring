<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddGames extends Migration
{

    private array $games = [
        [
            'app_id' => '10',
            'name' => 'Counter-Strike 1.6',
            'url' => 'cstrike',
        ],
        [
            'app_id' => '440',
            'name' => 'Team Fortress 2',
            'url' => 'tf',
        ],
        [
            'app_id' => '550',
            'name' => 'Left 4 Dead 2',
            'url' => 'left4dead2',
        ],
        [
            'app_id' => '730',
            'name' => 'Counter-Strike: Global Offensive',
            'url' => 'csgo',
        ],
        [
            'app_id' => '1002',
            'name' => 'Rag Doll Kung Fu',
            'url' => 'rdkf',
        ],
        [
            'app_id' => '2400',
            'name' => 'The Ship',
            'url' => 'theship',
        ],
        [
            'app_id' => '4000',
            'name' => 'Garrys Mod',
            'url' => 'garrysmod',
        ],
        [
            'app_id' => '17710',
            'name' => 'Nuclear Dawn',
            'url' => 'nucleardawn',
        ],
        [
            'app_id' => '70000',
            'name' => 'Dino D-Day',
            'url' => 'ddd',
        ],
        [
            'app_id' => '107410',
            'name' => 'Arma 3',
            'url' => 'Arma3',
        ],
        [
            'app_id' => '115300',
            'name' => 'Call of Duty: Modern Warfare 3',
            'url' => 'codmw3',
        ],
        [
            'app_id' => '211820',
            'name' => 'Starbound',
            'url' => 'starbound',
        ],
        [
            'app_id' => '244850',
            'name' => 'Space Engineers',
            'url' => 'Space Engineers',
        ],
        [
            'app_id' => '251570',
            'name' => '7 Days to Die',
            'url' => '7DTD',
        ],
        [
            'app_id' => '252490',
            'name' => 'Rust',
            'url' => 'rust',
        ],
        [
            'app_id' => '282440',
            'name' => 'Quake Live',
            'url' => 'baseq3',
        ],
        [
            'app_id' => '346110',
            'name' => 'ARK: Survival Evolved',
            'url' => 'ark_survival_evolved',
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('games')->insert($this->games);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('games')->delete();
    }
}
