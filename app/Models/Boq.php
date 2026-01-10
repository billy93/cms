<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Boq extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'code',
        'total_amount_items',
        'header',
        'subheader',
        'header_order',
    ];

    
    public static function generateCode(): string
    {
        $date = Carbon::now()->format('Ymd');
        do {
            $random = strtoupper(Str::random(5)); // AB12F
            $code = "BOQ-{$date}-{$random}";
        } while (Boq::where('code', $code)->exists()); // ensure unique in DB

        return $code;
    }

    public function replicateWithItems(?int $proposal_id = null): self
    {
        // Replikasi field, exclude beberapa field agar tidak duplikat
        $newBoq = $this->replicate(['proposal_id', 'invoice_id', 'created_at', 'updated_at']);

        $newBoq->proposal_id = $proposal_id;
        $newBoq->code = Boq::generateCode();
        $newBoq->save();

        foreach ($this->items as $item) {
            $newItem = $item->replicate(['boq_id', 'created_at', 'updated_at']);
            $newItem->boq_id = $newBoq->id;
            $newItem->save();
        }

        return $newBoq->load('items');
    }
    
    public function proposal(): BelongsTo 
    {
        return $this->belongsTo(Proposal::class);
    }

    // 🔹 Relasi ke BOQ Items
    public function items(): HasMany
    {
        return $this->hasMany(BoqItem::class);
    }
}
