<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoqTitle extends Model
{
    use HasFactory;

    protected $fillable = ['boq_id', 'title_name', 'position'];

    public function boq()
    {
        return $this->belongsTo(Boq::class);
    }
}
