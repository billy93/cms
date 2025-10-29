<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Boq extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'form_type',
        'description',
        'total_amount_items',
        'management_fee',
        'management_fee_type',
        'sales_amount',
        'vat',
        'vat_rate',
        'invoice_amount',
    ];

    
    public static function generateCode(): string
    {
        $prefix = 'BOQ' . date('Y');
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        return "{$prefix}{$random}";
    }

    public function proposal(): BelongsTo 
    {
        return $this->belongsTo(Proposal::class);
    }

    // 🔹 Relasi ke BOQ Items
    public function items(): HasMany
    {
        return $this->hasMany(BoqItem::class);
    }
}
