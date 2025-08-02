<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoqItemPrice extends Model
{
    use HasFactory;

    protected $fillable = ['boq_item_id', 'boq_title_id', 'amount'];

    public function item()
    {
        return $this->belongsTo(BoqItem::class, 'boq_item_id');
    }

    public function title()
    {
        return $this->belongsTo(BoqTitle::class, 'boq_title_id');
    }
}
