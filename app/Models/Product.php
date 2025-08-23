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
        'category',
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
}
