<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexForPortAndIpFromServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->index(['ip', 'port']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->dropIndex(['ip', 'port']);
        });
    }
}
