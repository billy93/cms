<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit',
        'base_cost',
        'category_id',
        'supplier_id'
    ];

    protected $casts = [
        'base_cost' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the supplier that owns the product.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    
    /**
     * Get the BOQ items related to this product.
     */
    public function boqItems(): HasMany
    {
        return $this->hasMany(BoqItem::class, 'product_id');
    }
}
