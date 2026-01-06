<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcmiBank extends Model
{
    protected $fillable = [
        'bank_id',
        'account_no',
        'branch',
        'swift_code',
        'holder_name',
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
