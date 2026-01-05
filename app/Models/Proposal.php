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
    ];

    protected $casts = [
        'status' => 'string',
        'pricing_model' => 'string',
        'management_fee_type' => 'string',
        'management_fee' => 'decimal:2',
        'vat_rate' => 'integer',
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
    
    public static function generateSalesCode($projectId, $proposalId)
    {
        $dateCode = now()->format('Ymd'); // contoh: 20251107

        // Ambil proposal + project
        $proposal = Proposal::with('project')->findOrFail($proposalId);
        $project = $proposal->project;

        // Ambil 5 karakter terakhir dari project code
        $projCodeRaw = $project->code ?? (string)$project->id;
        $projCodeLast5 = substr($projCodeRaw, -5);
        $projCodeLast5 = str_pad($projCodeLast5, 5, '0', STR_PAD_LEFT);

        // Ambil 5 karakter terakhir dari proposal code
        $propCodeRaw = $proposal->code ?? (string)$proposal->id;
        $propCodeLast5 = substr($propCodeRaw, -5);
        $propCodeLast5 = str_pad($propCodeLast5, 5, '0', STR_PAD_LEFT);

        // Ambil invoice terakhir dari proposal ini
        $latestInvoice = Invoice::where('proposal_id', $proposalId)
            ->orderByDesc('id')
            ->first();

        if ($latestInvoice && preg_match('/-(\d{3})$/', $latestInvoice->code, $m)) {
            $sequence = intval($m[1]) + 1;
        } else {
            $sequence = 1;
        }

        // Loop sampai dapat kode yang unik
        do {
            $seqCode = str_pad($sequence, 3, '0', STR_PAD_LEFT); // 001, 002, ...
            $candidate = "INV-{$projCodeLast5}-{$propCodeLast5}-{$dateCode}-{$seqCode}";

            $exists = Invoice::where('code', $candidate)->exists();
            $sequence++;
        } while ($exists);

        return $candidate;
    }
}