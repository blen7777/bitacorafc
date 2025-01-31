<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{

    protected $fillable = [
        'player_id',
        'match_id',
        'goals',
        'assists',
        'team_id',
        'yellow_cards',
        'red_cards',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function match()
    {
        return $this->belongsTo(Matches::class);
    }
}
