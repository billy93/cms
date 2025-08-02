<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'address',
        'contact_person',
        'phone',
        'email',
        'tax_number',
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
     * Generate unique supplier code
     */
    public static function generateSupplierCode()
    {
        $prefix = 'SUPP';
        
        // Get the highest supplier code number
        $lastSupplier = self::orderBy('supplier_code', 'desc')->first();
        
        if ($lastSupplier) {
            $lastNumber = (int) substr($lastSupplier->supplier_code, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists (in case of gaps or concurrent inserts)
        while (self::where('supplier_code', $newCode)->exists()) {
            $newNumber++;
            $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        }
        
        return $newCode;
    }

    /**
     * Scope for active suppliers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive suppliers
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Search suppliers by name, code, or contact person
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('supplier_name', 'like', "%{$search}%")
              ->orWhere('supplier_code', 'like', "%{$search}%")
              ->orWhere('contact_person', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('tax_number', 'like', "%{$search}%");
        });
    }

    /**
     * Boot method to add event listeners
     */
    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($supplier) {
            \Log::info('Supplier created: ' . $supplier->supplier_code);
        });
    }

    /**
     * Get supplier's full address
     */
    public function getFullAddressAttribute()
    {
        return $this->address;
    }

    /**
     * Check if supplier is active
     */
    public function isActive()
    {
        return $this->status === 'active';
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
     * Get all PICs for this supplier
     */
    public function pics()
    {
        return $this->hasMany(SupplierPic::class);
    }

    /**
     * Get active PICs for this supplier
     */
    public function activePics()
    {
        return $this->hasMany(SupplierPic::class)->active();
    }

    /**
     * Relationships will be added here when other models are created
     */
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    // public function purchaseOrders()
    // {
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}
