<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
protected $fillable = [
    'subject',
    'body',
    'initdate',
    'limitdate',
    'finish',
    'categoria',
    'user_id'
  ];

    public function users(){
      return $this->belongsTo(User::class);
    }
}
