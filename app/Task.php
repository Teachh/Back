<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Authenticatable
{

    public function users(){
      return $this->belongsTo(User::class);
    }
}
