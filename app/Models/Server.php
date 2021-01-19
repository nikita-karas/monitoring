<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'ip',
        'port',
        'name',
        'players',
        'max_players',
        'map',
        'online',
        'password',
        'secure',
        'fail_attempts',
        'user_id'
    ];

    public function game()
    {
       return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
