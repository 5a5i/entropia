<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class persons extends Model
{

  protected $fillable = [
    'id',
    'name',
    'sex',
    'dob',
    'bio',
    'role',
    'created_at',
    'updated_at'
  ];

    public function movies()
    {
        return $this->hasMany('App\Models\movies');
    }

    public function cast()
    {
        return $this->hasMany('App\Models\casts');
    }
}
