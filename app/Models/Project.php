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
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',  
        'end_date' => 'date',
        'due_date' => 'date',
        'status' => 'string',
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
        } while (Boq::where('code', $code)->exists()); 

        return $code;
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

    /**
     * Accessor: format numeric value ke format Rupiah saat dibaca
     */
    public function getValueAttribute($value)
    {
        return number_format($value ?? 0, 2, ',', '.'); // contoh: 1.250.000,50
    }
}