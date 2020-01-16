<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
protected $fillable = [
	'title',
    'subject',
    'body',
    'initdate',
    'limitdate',
    'finish',
    'categoria',
    'user_id'
  ];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
