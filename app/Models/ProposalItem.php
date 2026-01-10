<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productPriceVersion()
    {
        return $this->belongsTo(ProductPriceVersion::class);
    }
}
