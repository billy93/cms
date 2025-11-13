<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'position',
        'status',
        'notes'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the customer that owns the PIC
     */
    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }

    /**
     * Scope for active PICs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive PICs
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Check if PIC is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get full contact info
     */
    public function getFullContactInfoAttribute()
    {
        $info = $this->name;
        if ($this->position) {
            $info .= ' (' . $this->position . ')';
        }
        if ($this->phone) {
            $info .= ' - ' . $this->phone;
        }
        if ($this->email) {
            $info .= ' - ' . $this->email;
        }
        return $info;
    }
}
