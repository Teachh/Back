<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'date',
    'price',
    'user_id'
  ];

  public function products()
  {
    return $this->belongsToMany(Product::class)->withPivot('id','Quantity','product_id','Quantity');;
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
