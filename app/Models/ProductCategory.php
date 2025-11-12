<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
  use HasFactory;

  protected $table = 'product_categories';

  protected $fillable = [
    'name',
    'description',
  ];
  
  // Category belongs to many products
  public function products()
  {
    return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')
                ->withTimestamps();
  } 
}
