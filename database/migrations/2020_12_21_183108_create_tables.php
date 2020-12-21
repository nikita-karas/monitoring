<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id')->unique();
            $table->string('url')->unique();
            $table->string('name');
        });

        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games');
            $table->ipAddress('ip');
            $table->integer('port');
            $table->string('name')->nullable();
            $table->integer('players');
            $table->integer('max_players');
            $table->string('map')->nullable();
            $table->boolean('online');
            $table->boolean('password');
            $table->boolean('secure');
            $table->integer('fail_attempts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
        Schema::dropIfExists('games');
    }
}
