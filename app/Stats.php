<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{ 
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matches', 'runs', 'highest_score', 'fifties' , 'hundreds', 'player_id', 'created_at', 'updated_at'
    ];

    protected $table = 'tbl_player_stats';
}
