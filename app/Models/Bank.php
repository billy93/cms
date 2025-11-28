<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bank extends Model
{
    use HasFactory;

    // This tells Laravel: "It is safe to save data into these columns"
    protected $fillable = [
        'bank_code',
        'bank_name',
        'bank_address',
    ];
}
