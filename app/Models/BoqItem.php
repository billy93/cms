<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoqItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'boq_id',
        'product_id',
        'product_price_version_id',
        'description',
        'selling_price',
        'qty',
        'qty_unit',
        'freq',
        'freq_unit',
        'total_price',
    ];

    /**
     * Relasi ke BOQ.
     */
    public function boq(): BelongsTo
    {
        return $this->belongsTo(Boq::class);
    }

    /**
     * Relasi ke Product (opsional).
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the active price version of this product.
     */
    public function getProductActivePriceAttribute()
    {
        return $this->product->activePriceVersion->price ?? 0;
    }
    
    /**
     * Relasi ke ProductPriceVersion (snapshot reference).
     */
    public function productPriceVersion(): BelongsTo
    {
        return $this->belongsTo(ProductPriceVersion::class, 'product_price_version_id');
    }
}
