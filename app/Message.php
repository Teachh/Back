<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'title',
      'body',
      'date'
    ];

    public function users(){
      return $this->belongsTo(User::class);
    }
}
