<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany; 
 
class Proposal extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $appends = [
        'calculated_management_fee',
        'sales_amount',
        'vat_amount',
        'invoice_amount'
    ];

    protected $fillable = [
        'project_id',
        'code',
        'sales_code',
        'note',
        'status',
        'pricing_model',
        'management_fee_type',
        'management_fee',
        'vat_rate',
        'pricing_model_description',
        'total_amount_items',
    ];

    protected $casts = [
        'status' => 'string',
        'pricing_model' => 'string',
        'management_fee_type' => 'string',
        'management_fee' => 'decimal:2',
        'vat_rate' => 'decimal:2',
    ];

    /**
     * Relationship with Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function boqs(): HasMany
    {
        return $this->hasMany(Boq::class);
    }

    /**
     * Get BOQs grouped by header for Type C/D pricing
     */
    public function boqsGroupedByHeader()
    {
        return $this->boqs()
            ->orderBy('header_order')
            ->orderBy('id')
            ->get()
            ->groupBy('header');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SalesItem::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Generate unique Proposal code
     */
    public static function generateCode(): string
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5)); // AB12F
            $code = "PRP-{$date}-{$random}";
        } while (Proposal::where('code', $code)->exists()); // ensure unique in DB

        return $code;
    }
    
    public function generateSalesCode()
    {
        $dateCode = now()->format('Ymd');
        
        // Get 5 chars from proposal code
        // Note: For existing proposals this works. For new ones, ensure 'code' is set before calling this.
        $propCodeRaw = $this->code ?? (string)$this->id;
        $propCodeLast5 = substr($propCodeRaw, -5);
        $propCodeLast5 = str_pad($propCodeLast5, 5, '0', STR_PAD_LEFT);

        // Get latest invoice for THIS proposal
        $latestInvoice = $this->invoices()->orderByDesc('id')->first();

        if ($latestInvoice && preg_match('/-(\d{3})$/', $latestInvoice->code, $m)) {
            $sequence = intval($m[1]) + 1;
        } else {
            $sequence = 1;
        }

        do {
            $seqCode = str_pad($sequence, 3, '0', STR_PAD_LEFT);
            $candidate = "REG-{$propCodeLast5}-{$dateCode}-{$seqCode}";

            // Check uniqueness in Invoices
            $exists = Invoice::where('code', $candidate)->exists();
            
            // Also check Proposal's sales_code uniqueness (to avoid duplicates if multiple proposals generated)
            if (!$exists) {
                 $exists = Proposal::where('sales_code', $candidate)->where('id', '!=', $this->id)->exists();
            }
            
            if ($exists) $sequence++;
        } while ($exists);

        return $candidate;
    }

    // Accessors
    public function getCalculatedManagementFeeAttribute()
    {
        $basic = (float) $this->total_amount_items;
        $fee = (float) $this->management_fee;
        
        if ($this->management_fee_type === 'percent') {
            return round($basic * ($fee / 100), 2);
        }
        return round($fee, 2);
    }

    public function getSalesAmountAttribute()
    {
        return round((float) $this->total_amount_items + $this->calculated_management_fee, 2);
    }

    public function getVatAmountAttribute()
    {
        return round($this->sales_amount * ((float) $this->vat_rate / 100), 2);
    }

    public function getInvoiceAmountAttribute()
    {
        return round($this->sales_amount + $this->vat_amount, 2);
    }
}