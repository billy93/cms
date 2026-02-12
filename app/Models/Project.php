<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'ref_doc_no',
        'value',
        'start_date',
        'end_date',
        'due_date',
        'description',
        'customer_id',
        'status',
        'type',
        'sales_code'
    ];

    protected $casts = [
        'start_date' => 'date',  
        'end_date' => 'date',
        'due_date' => 'date',
        'status' => 'string',
        'type' => 'string',
    ];

    /**
     * Generate unique project code
     */
    public static function generateCode()
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5));
            $code = "PRJ-{$date}-{$random}";
        } while (Project::where('code', $code)->exists()); 

        return $code;
    }


    public function generateSalesCode()
    {
        $dateCode = now()->format('Ymd');
        
        // Get 5 chars from project code
        $projCodeRaw = $this->code ?? (string)$this->id;
        $projCodeLast5 = substr($projCodeRaw, -5);
        $projCodeLast5 = str_pad($projCodeLast5, 5, '0', STR_PAD_LEFT);

        // FIT projects don't have proposals, so we skip propCodeLast5 or use '00000'? 
        // User pattern: FIT-...-urutan sequence.
        // Let's assume FIT-{Proj}-{Date}-{Seq}

        // Get latest invoice for THIS project
        $latestInvoice = $this->invoices()->orderByDesc('id')->first();

        if ($latestInvoice && preg_match('/-(\d{3})$/', $latestInvoice->code, $m)) {
            $sequence = intval($m[1]) + 1;
        } else {
            $sequence = 1;
        }

        do {
            $seqCode = str_pad($sequence, 3, '0', STR_PAD_LEFT);
            $candidate = "FIT-{$projCodeLast5}-{$dateCode}-{$seqCode}";

            // Check uniqueness in Invoices (since this will be an invoice code)
            $exists = Invoice::where('code', $candidate)->exists();
            // Also check current Project's sales_code to avoid self-collision if running multiple times before invoice creation?
            // Actually usually sales_code on Project is just the FIRST one.
            if (!$exists) {
                 // Check if any OTHER project has this sales_code (unlikely with ProjCode included)
                 $exists = Project::where('sales_code', $candidate)->where('id', '!=', $this->id)->exists();
            }
            
            if ($exists) $sequence++;
        } while ($exists);

        return $candidate;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeWithCustomer($query)
    {
        return $query->with('customer');
    }

    public function scopeWithProposal($query)
    {
        return $query->with('proposals');
    }

    public function setValueAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['value'] = 0;
            return;
        }

        // Bersihkan simbol dan separator ribuan
        $clean = preg_replace('/[^0-9,]/', '', $value);

        // Ubah koma ke titik, hapus titik ribuan
        $clean = str_replace(',', '.', str_replace('.', '', $clean));

        // Simpan sebagai float
        $this->attributes['value'] = (float) $clean;
    }

    public function getValueAttribute($value)
    {
        return number_format($value ?? 0, 2, ',', '.'); 
    }
}