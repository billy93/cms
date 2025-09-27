<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'boq_code',
        'sales_code',
        'type_of_sales_code',
        'year_of_sales',
        'destination',
        'city',
        'activity',
        'date_from',
        'date_to',
        'invoice_no',
        'pricing_model',
        'status'
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
        'status' => 'string',
    ];

    /**
     * Relationship with Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function boqs(): BelongsToMany
    {
        return $this->belongsToMany(Boq::class, 'boq_proposal');
    }
    /**
     * Generate unique BOQ code
     */
    public static function generateBoqCode()
    {
        $prefix = 'BOQ';
        
        // Get the highest BOQ code number
        $lastProposal = self::orderBy('boq_code', 'desc')->first();
        
        if ($lastProposal) {
            $lastNumber = (int) substr($lastProposal->boq_code, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists
        while (self::where('boq_code', $newCode)->exists()) {
            $newNumber++;
            $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        }
        
        return $newCode;
    }

    /**
     * Generate unique sales code
     */
    public static function generateSalesCode()
    {
        $prefix = 'SALES';
        
        // Get the highest sales code number
        $lastProposal = self::orderBy('sales_code', 'desc')->first();
        
        if ($lastProposal) {
            $lastNumber = (int) substr($lastProposal->sales_code, 5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        
        // Check if code already exists
        while (self::where('sales_code', $newCode)->exists()) {
            $newNumber++;
            $newCode = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        }
        
        return $newCode;
    }

    /**
     * Get type of sales code options
     */
    public static function getTypeOfSalesCodeOptions()
    {
        return [
            'FIT' => 'FIT',
            'Non FIT' => 'Non FIT'
        ];
    }

    /**
     * Get year options (5 years back and 5 years forward)
     */
    public static function getYearOptions()
    {
        $currentYear = date('Y');
        $years = [];
        
        for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++) {
            $years[$i] = $i;
        }
        
        return $years;
    }

    /**
     * Get destination options
     */
    public static function getDestinationOptions()
    {
        return [
            'Indonesia' => 'Indonesia',
            'Overseas' => 'Overseas'
        ];
    }

    /**
     * Get city options
     */
    public static function getCityOptions()
    {
        return [
            'City in Indonesia' => 'City in Indonesia',
            'Overseas' => 'Overseas'
        ];
    }

    /**
     * Get activity options
     */
    public static function getActivityOptions()
    {
        return [
            'Awarding' => 'Awarding',
            'Conference and Seminar' => 'Conference and Seminar',
            'Exhibitions' => 'Exhibitions',
            'Gala Dinner' => 'Gala Dinner',
            'Gathering' => 'Gathering',
            'Holidays' => 'Holidays',
            'Incentive Trip' => 'Incentive Trip',
            'Meeting' => 'Meeting',
            'Product Launching' => 'Product Launching',
            'Shareholders Meeting (RUPS)' => 'Shareholders Meeting (RUPS)',
            'Workshop' => 'Workshop',
            'Others' => 'Others'
        ];
    }

    /**
     * Get pricing model options
     */
    public static function getPricingModelOptions()
    {
        return [
            'All inclusive package' => 'All inclusive package',
            'All inclusive - Price Per Person' => 'All inclusive - Price Per Person',
            'Simple package' => 'Simple package',
            'Free format' => 'Free format',
            'Itemized' => 'Itemized'
        ];
    }

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            'draft' => 'Draft',
            'submitted' => 'Submitted',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'cancelled' => 'Cancelled'
        ];
    }

    /**
     * Scope for active proposals
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'cancelled');
    }

    /**
     * Scope for proposals with project
     */
    public function scopeWithProject($query)
    {
        return $query->with('project');
    }

    /**
     * Generate unique invoice number
     */
    public static function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $year = date('Y');
        $month = date('m');
        
        // Get the highest invoice number for current year and month
        $lastProposal = self::where('invoice_no', 'like', $prefix . $year . $month . '%')
                           ->orderBy('invoice_no', 'desc')
                           ->first();
        
        if ($lastProposal) {
            // Extract the sequence number from the last invoice
            $lastSequence = (int) substr($lastProposal->invoice_no, -4);
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }
        
        // Format: INV202412XXXX (INV + Year + Month + 4-digit sequence)
        return $prefix . $year . $month . str_pad($newSequence, 4, '0', STR_PAD_LEFT);
    }
}