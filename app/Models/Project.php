<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'customer_id',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Generate unique project code
     */
    public static function generateCode()
    {
        $prefix = 'PROJ';
        
        // Get the highest project code number
        $lastProject = self::orderBy('code', 'desc')->first();
        
        if ($lastProject) {
            $lastNumber = (int) substr($lastProject->code, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists (in case of gaps or concurrent inserts)
        while (self::where('code', $newCode)->exists()) {
            $newNumber++;
            $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        }
        
        return $newCode;
    }

    /**
     * Relationship with Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship with Proposal (one-to-one)
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function hasProposal()
    {
        return $this->proposal()->exists();
    }

    /**
     * Scope for active projects
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope for projects with customer
     */
    public function scopeWithCustomer($query)
    {
        return $query->with('customer');
    }

    /**
     * Scope for projects with proposal
     */
    public function scopeWithProposal($query)
    {
        return $query->with('proposals');
    }
}