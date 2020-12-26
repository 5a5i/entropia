<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class v_casts extends Model
{
  protected $fillable = [
    'movie_id',
    'actor_id',
    'name'
  ];
}
