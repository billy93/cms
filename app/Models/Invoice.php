<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'project_id',
        'customer_id',
        'code',
        'invoice_date',
        'due_date',
        'description',
        'status',
        'type',
        'payment_method',
        'bill_to',
        'ship_to',
        'total_amount',
        'management_fee',
        'management_fee_type',
        'vat_rate', 
        'note',
        'terms_and_conditions',
        'signature_name',
        'signature_image',
    ];

    protected $appends = [
        'management_fee_amount',
        'sales_amount',
        'vat_amount',
        'invoice_amount',
    ];

    /**
     * Get the management fee calculation result.
     * Note: 'management_fee' column stores the RATE (if percent) or AMOUNT (if nominal).
     */
    public function getManagementFeeAmountAttribute()
    {
        $totalAmount = (float) $this->total_amount;
        $feeValue = (float) $this->management_fee;

        if ($this->management_fee_type === 'percent') {
            return ($totalAmount * $feeValue) / 100;
        }

        return $feeValue;
    }

    public function getSalesAmountAttribute()
    {
        return (float) $this->total_amount + $this->management_fee_amount;
    }

    public function getVatAmountAttribute()
    {
        $salesAmount = $this->sales_amount;
        $vatRate = (float) $this->vat_rate;
        return ($salesAmount * $vatRate) / 100;
    }

    public function getInvoiceAmountAttribute()
    {
        return round($this->sales_amount + $this->vat_amount, 2);
    }

   public static function generateCode(Proposal $proposal): string
    {
        $date = now()->format('ymd'); // contoh: 251104
        $cleanCode = preg_replace('/[^A-Za-z0-9]/', '', strtoupper($proposal->code)); // hilangkan simbol

        // Ambil 3 karakter pertama + 5 terakhir
        $prefixCode = substr($cleanCode, 0, 3) . substr($cleanCode, -5);

        $prefix = "INV-{$prefixCode}-{$date}";

        // Hitung jumlah invoice untuk proposal ini hari ini
        $count = Invoice::where('proposal_id', $proposal->id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // 2 karakter random alfanumerik
        $random = strtoupper(Str::random(2));

        return sprintf("%s-%03d%s", $prefix, $count, $random);
    }

    public static function generateCodeFromProject(Project $project): string
    {
        $date = now()->format('ymd'); // Example: 250120
        
        // Project Code or ID
        $projCodeRaw = $project->code ?? (string)$project->id;
        // Clean and get last 5 chars
        $cleanCode = preg_replace('/[^A-Za-z0-9]/', '', strtoupper($projCodeRaw));
        $projLast5 = substr($cleanCode, -5);
        $projLast5 = str_pad($projLast5, 5, '0', STR_PAD_LEFT);

        // Format: FIT-{ProjLast5}-{Date}-{Seq}
        $prefix = "FIT-{$projLast5}-{$date}";

        // Sequence: Count invoices for this project (direct link)
        // We use starts_with check or exact project_id match. 
        // Since we added project_id column, we can use that.
        $count = Invoice::where('project_id', $project->id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // Optionally add random string like the other generator? 
        // User requested "FIT-...-urutan invoice" (Sequence).
        // The other generator does "%s-%03d%s" (Prefix-Seq-Random).
        // I will follow the other generator's pattern for consistency unless "FIT" implies strict format.
        // Let's stick to the user's "FIT" format request from step 160 but maybe adding random chars for safety is better?
        // User said: "FIT- ... - urutan invoice".
        // Let's do: FIT-{ProjLast5}-{Date}-{SeqWithPadding}
        
        return sprintf("%s-%03d", $prefix, $count);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(ProposalItem::class);
    }

    /**
     * Shortcut to get Project via Proposal
     */


    /**
     * Calculate total from BOQs (optional helper)
     */
    public function calculateTotalAmount()
    {
        return $this->total_amount_items;
    }
}
