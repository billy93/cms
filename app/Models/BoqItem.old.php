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
        'header',
        'subheader',
        'product_id',
        'unit_price',
        'title1_key',
        'title1_value',
        'title2_key',
        'title2_value',
        'title3_key',
        'title3_value',
        'title4_key',
        'title4_value',
        'multiplier_total',
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
}
