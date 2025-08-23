<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    // Note: Products table uses enum 'category' field, not foreign key relationship
    // If you need to get products by category name, use where clause on category field
}
