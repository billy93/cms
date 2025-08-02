<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_code',
        'customer_name',
        'address',
        'contact_person',
        'phone',
        'email',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'notes'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Generate unique customer code
     */
    public static function generateCustomerCode()
    {
        $prefix = 'CUST';
        
        // Get the highest customer code number
        $lastCustomer = self::orderBy('customer_code', 'desc')->first();
        
        if ($lastCustomer) {
            $lastNumber = (int) substr($lastCustomer->customer_code, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists (in case of gaps or concurrent inserts)
        while (self::where('customer_code', $newCode)->exists()) {
            $newNumber++;
            $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        }
        
        return $newCode;
    }

    /**
     * Scope for active customers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive customers
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Search customers by name, code, or contact person
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'like', "%{$search}%")
              ->orWhere('customer_code', 'like', "%{$search}%")
              ->orWhere('contact_person', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Boot method to add event listeners
     */
    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($customer) {
            \Log::info('Customer created: ' . $customer->customer_code);
        });
    }

    /**
     * Get customer's full address for proposal
     */
    public function getFullAddressAttribute()
    {
        return $this->address;
    }

    /**
     * Check if customer is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get all PICs for this customer
     */
    public function pics()
    {
        return $this->hasMany(CustomerPic::class);
    }

    /**
     * Get active PICs for this customer
     */
    public function activePics()
    {
        return $this->hasMany(CustomerPic::class)->active();
    }

    /**
     * Get formatted bank account info
     */
    public function getBankInfoAttribute()
    {
        if ($this->bank_name && $this->bank_account_number) {
            return $this->bank_name . ' - ' . $this->bank_account_number . ' (' . $this->bank_account_name . ')';
        }
        return null;
    }

    /**
     * Relationships will be added here when other models are created
     */
    // public function boqs()
    // {
    //     return $this->hasMany(Boq::class);
    // }

    // public function proposals()
    // {
    //     return $this->hasMany(Proposal::class);
    // }

    // public function invoices()
    // {
    //     return $this->hasMany(Invoice::class);
    // }
} 