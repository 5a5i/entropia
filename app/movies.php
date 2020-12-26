<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
  protected $fillable = [
    'id',
    'name',
    'year',
    'plot',
    'poster',
    'producer_id',
    'actor_id',
    'created_at',
    'updated_at'
  ];

    // public function casts()
    // {
    //     return $this->belongsTo('App\Models\casts');
    // }

    // public function persons()
    // {
    //     return $this->belongsTo('App\Models\persons');
    // }
}
