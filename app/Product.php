<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Allergen;
use App\Order;
use App\Ingredient;
use App\Category;

class Product extends Model
{
  protected $fillable = [
    'name',
    'description',
    'price',
    'stock'
  ];

  public function allergens()
  {
    return $this->belongsToMany(Allergen::class);
  }

  public function orders()
  {
    return $this->belongsToMany(Order::class);
  }

  public function ingredients()
  {
    return $this->belongsToMany(Ingredient::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
