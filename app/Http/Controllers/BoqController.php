<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Boq;
use Illuminate\Http\Request;
use App\Models\BoqTitle;
use App\Models\BoqItem;
use App\Models\BoqItemPrice;
use Illuminate\Support\Facades\DB;

class BoqController extends Controller
{
    public function index()
    {
        $boqs = Boq::with(['items.prices', 'titles'])->get();
        return response()->json($boqs);
    }

    public function store(Request $request)
    {
        // $boq = Boq::create($request->only(['boq_type', 'customer_name', 'sales_code']));
        // return response()->json($boq, 201);

        DB::transaction(function () use ($request) {
            $boq = Boq::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            foreach ($request->titles as $titleData) {
                $title = $boq->titles()->create([
                    'title_name' => $titleData['title_name'],
                    'position' => $titleData['position'],
                ]);

                foreach ($titleData['items'] as $itemData) {
                    $item = $title->items()->create([
                        'item_name' => $itemData['item_name'],
                        'description' => $itemData['description'],
                    ]);

                    foreach ($itemData['prices'] as $priceData) {
                        $item->prices()->create([
                            'title' => $priceData['title'],
                            'amount' => $priceData['amount'],
                        ]);
                    }
                }
            }
        });

        return response()->json(['message' => 'BOQ created successfully'], 201);
    }

    public function show($id)
    {
        $boq = Boq::with(['items.prices', 'titles'])->findOrFail($id);
        return response()->json($boq);
    }

    public function update(Request $request, $id)
    {
        $boq = Boq::findOrFail($id);
        $boq->update($request->only(['boq_type', 'customer_name', 'sales_code']));
        return response()->json($boq);
    }

    public function destroy($id)
    {
        $boq = Boq::findOrFail($id);
        $boq->delete();
        return response()->json(null, 204);
    }
}
