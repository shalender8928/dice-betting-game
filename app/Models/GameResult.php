<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $fillable = [
        'dice1',
        'dice2',
        'sum',
        'bet',
        'result',
        'win_amount',
        'balance'
    ];
}
