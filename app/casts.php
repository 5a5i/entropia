<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class casts extends Model
{
  protected $fillable = [
    'id',
    'movie_id',
    'actor_id'
  ];

  // public function getCastNameAttribute($value)
  // {
  //     return $this->person->name;
  // }

  public function movies()
  {
      return $this->hasMany('App\Models\movies');
  }

  // public function person()
  // {
  //     return $this->hasOne('App\Models\persons','actor_id');
  // }
}
