<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'notes'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public static function generateCode(): string
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5));
            $code = "CST-{$date}-{$random}";
        } while (Boq::where('code', $code)->exists()); 

        return $code;
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function billingOptions()
    {
        return $this->hasMany(BillingOption::class);
    }
} 