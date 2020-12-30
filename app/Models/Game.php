<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use xPaw\SourceQuery\SourceQuery;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'url',
        'name',
    ];

    public function servers()
    {
       return $this->hasMany(Server::class);
    }

    public function getQueryPort(int $port)
    {
        switch ($this->app_id) {
            case 107410:
            case 244850:
                return $port + 1;
        }
        return $port;
    }

    public function getQueryEngine()
    {
        switch ($this->app_id) {
            case 10:
                return SourceQuery::GOLDSOURCE;
        }
        return SourceQuery::SOURCE;
    }
}
