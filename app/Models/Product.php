<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'unit',
        'base_cost',
        'supplier_id',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public static function generateCode()
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5));
            $code = "PRD-{$date}-{$random}";
        } while (Product::where('code', $code)->exists()); 

        return $code;
    }
    
    // Product belongs to one supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Product belongs to many categories
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product', 'product_id', 'category_id')
                    ->withTimestamps();
    }

    /**
 * Get the BOQ items related to this product.
 */
    public function boqItems(): HasMany
    {
        return $this->hasMany(BoqItem::class, 'product_id');
    }
}
