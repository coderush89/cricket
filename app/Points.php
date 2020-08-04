<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{ 
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'points', 'created_at', 'updated_at'
    ];

    protected $table = 'tbl_points';
}
