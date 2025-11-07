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
        'customer_id',
        'code',
        'invoice_date',
        'due_date',
        'status',
        'type',
        'payment_method',
        'bill_to',
        'ship_to',
        'total_amount',
        'notes',
        'terms_and_conditions',
        'signature_name',
        'signature_image',
    ];

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

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function boqs()
    {
        return $this->hasMany(Boq::class);
    }

    /**
     * Shortcut to get Project via Proposal
     */
    public function project()
    {
        return $this->hasOneThrough(
            Project::class,
            Proposal::class,
            'id',           // FK Proposal.id
            'id',           // FK Project.id
            'proposal_id',  // Local key Invoice.proposal_id
            'project_id'    // Local key Proposal.project_id
        );
    }

    /**
     * Calculate total from BOQs (optional helper)
     */
    public function calculateTotalAmount()
    {
        return $this->boqs()->sum('invoice_amount'); // asumsi BOQ punya invoice_amount
    }
}
