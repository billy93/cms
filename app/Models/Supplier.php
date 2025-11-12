<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
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
    public static function generateCode()
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5));
            $code = "SUP-{$date}-{$random}";
        } while (Boq::where('code', $code)->exists()); 

        return $code;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
