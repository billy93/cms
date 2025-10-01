<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boq extends Model
{
    use HasFactory;
    protected $fillable = [
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


    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'boq_project');
    }

    public function proposals(): BelongsToMany
    {
        return $this->belongsToMany(Proposal::class, 'boq_proposal');
    }

    // 🔹 Relasi ke BOQ Items
    public function items(): HasMany
    {
        return $this->hasMany(BoqItem::class);
    }
}
