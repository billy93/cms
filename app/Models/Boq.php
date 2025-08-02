<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boq extends Model
{
    use HasFactory;

    protected $fillable = ['boq_type', 'customer_name', 'sales_code'];

    public function items()
    {
        return $this->hasMany(BoqItem::class);
    }

    public function titles()
    {
        return $this->hasMany(BoqTitle::class);
    }
}
