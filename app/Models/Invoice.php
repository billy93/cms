<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = [
        'client_id',
        'bill_to',
        'ship_to',
        'project_id',
        'amount',
        'currency',
        'invoice_date',
        'due_date',
        'payment_method',
        'status',
        'description',
        'signature_name',
        'signature_image',
        'notes',
        'terms_and_conditions',
        'subtotal',
        'discount',
        'extra_discount',
        'tax',
        'total',
    ];
}
