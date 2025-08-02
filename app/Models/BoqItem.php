<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoqItem extends Model
{
    use HasFactory;

    protected $fillable = ['boq_id', 'product_name', 'description', 'pricing_model', 'sales_amount'];

    public function boq()
    {
        return $this->belongsTo(Boq::class);
    }

    public function prices()
    {
        return $this->hasMany(BoqItemPrice::class);
    }
}
