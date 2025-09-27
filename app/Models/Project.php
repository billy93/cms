<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_code',
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
    public static function generateProjectCode()
    {
        $prefix = 'PROJ';
        
        // Get the highest project code number
        $lastProject = self::orderBy('project_code', 'desc')->first();
        
        if ($lastProject) {
            $lastNumber = (int) substr($lastProject->project_code, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists (in case of gaps or concurrent inserts)
        while (self::where('project_code', $newCode)->exists()) {
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
    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }

    public function boqs(): BelongsToMany
    {
        return $this->belongsToMany(Boq::class, 'boq_project');
    }
    /**
     * Check if project has a proposal
     */
    public function hasProposal()
    {
        return $this->proposal()->exists();
    }

    /**
     * Get project status options
     */
    public static function getStatusOptions()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
    }

    /**
     * Scope for active projects
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
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
        return $query->with('proposal');
    }
}