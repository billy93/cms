<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductPriceVersion extends Model
{
    protected $fillable = [
        'product_id',
        'version',
        'price',
        'is_active',
        'effective_from',
        'effective_until',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'effective_from' => 'datetime',
        'effective_until' => 'datetime',
    ];

    /**
     * Relationship: ProductPriceVersion belongs to Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: ProductPriceVersion has many BoqItems
     */
    public function boqItems(): HasMany
    {
        return $this->hasMany(BoqItem::class, 'product_price_version_id');
    }

    /**
     * Scope: Get only active versions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor: Format price as Rupiah
     */
    public function getFormattedPriceAttribute(): string
    {
        return formatRupiah($this->price);
    }
}
