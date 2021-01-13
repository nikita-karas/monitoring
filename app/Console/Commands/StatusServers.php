<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Server;
use App\Jobs\UpdateServerJob;

class StatusServers extends Command
{
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
        $data = Server::with('game')->get();
        foreach ($data as $server) {
            UpdateServerJob::dispatch($server);
        }
        return 0;
    }
}
