<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'cp_name',
        'cp_title_division',
        'cp_email',
        'cp_office_number',
        'cp_mobile_number',
        'is_overseas',
        'address',
    ];

    protected $casts = [
        'is_overseas' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
