<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type','type_id', 'team_id', 'paid', 'free'
    ];

}
