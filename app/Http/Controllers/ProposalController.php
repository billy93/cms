<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $proposals = Proposal::with(['project', 'project.customer'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $proposals->items(),
                'pagination' => [
                    'current_page' => $proposals->currentPage(),
                    'last_page' => $proposals->lastPage(),
                    'per_page' => $proposals->perPage(),
                    'total' => $proposals->total()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching proposals: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'boq_code' => 'required|string|max:255|unique:proposals,boq_code',
            'sales_code' => 'required|string|max:255|unique:proposals,sales_code',
            'type_of_sales_code' => 'required|in:FIT,Non FIT',
            'year_of_sales' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . (date('Y') + 5),
            'destination' => 'required|in:Indonesia,Overseas',
            'city' => 'required|string|max:255',
            'activity' => 'required|in:Awarding,Conference and Seminar,Exhibitions,Gala Dinner,Gathering,Holidays,Incentive Trip,Meeting,Product Launching,Shareholders Meeting (RUPS),Workshop,Others',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'pricing_model' => 'required|in:All inclusive package,All inclusive - Price Per Person,Simple package,Free format,Itemized'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Check if project already has a proposal
            $existingProposal = Proposal::where('project_id', $request->project_id)->first();
            if ($existingProposal) {
                return response()->json([
                    'success' => false,
                    'message' => 'This project already has a proposal'
                ], 422);
            }

            DB::beginTransaction();

            $proposal = new Proposal();
            $proposal->project_id = $request->project_id;
            $proposal->boq_code = $request->boq_code;
            $proposal->sales_code = $request->sales_code;
            $proposal->type_of_sales_code = $request->type_of_sales_code;
            $proposal->year_of_sales = $request->year_of_sales;
            $proposal->destination = $request->destination;
            $proposal->city = $request->city;
            $proposal->activity = $request->activity;
            $proposal->date_from = $request->date_from;
            $proposal->date_to = $request->date_to;
            $proposal->pricing_model = $request->pricing_model;
            
            // Auto-generate invoice number
            $proposal->invoice_no = $proposal->generateInvoiceNumber();
            
            $proposal->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Proposal created successfully',
                'data' => $proposal->load(['project', 'project.customer'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $proposal = Proposal::with(['project', 'project.customer'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $proposal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'boq_code' => 'required|string|max:255|unique:proposals,boq_code,' . $id,
            'sales_code' => 'required|string|max:255|unique:proposals,sales_code,' . $id,
            'type_of_sales_code' => 'required|in:FIT,Non FIT',
            'year_of_sales' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . (date('Y') + 5),
            'destination' => 'required|in:Indonesia,Overseas',
            'city' => 'required|string|max:255',
            'activity' => 'required|in:Awarding,Conference and Seminar,Exhibitions,Gala Dinner,Gathering,Holidays,Incentive Trip,Meeting,Product Launching,Shareholders Meeting (RUPS),Workshop,Others',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'pricing_model' => 'required|in:All inclusive package,All inclusive - Price Per Person,Simple package,Free format,Itemized'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $proposal = Proposal::findOrFail($id);

            DB::beginTransaction();

            $proposal->boq_code = $request->boq_code;
            $proposal->sales_code = $request->sales_code;
            $proposal->type_of_sales_code = $request->type_of_sales_code;
            $proposal->year_of_sales = $request->year_of_sales;
            $proposal->destination = $request->destination;
            $proposal->city = $request->city;
            $proposal->activity = $request->activity;
            $proposal->date_from = $request->date_from;
            $proposal->date_to = $request->date_to;
            $proposal->pricing_model = $request->pricing_model;
            
            $proposal->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Proposal updated successfully',
                'data' => $proposal->load(['project', 'project.customer'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $proposal = Proposal::findOrFail($id);
            $proposal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Proposal deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get proposal by project ID
     */
    public function getByProject($projectId)
    {
        try {
            $proposal = Proposal::with(['project', 'project.customer'])
                ->where('project_id', $projectId)
                ->first();

            if (!$proposal) {
                return response()->json([
                    'success' => false,
                    'message' => 'No proposal found for this project'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $proposal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cities based on destination
     */
    public function getCities(Request $request)
    {
        $destination = $request->get('destination');
        
        if ($destination === 'Indonesia') {
            $cities = [
                'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Palembang',
                'Tangerang', 'Depok', 'Bekasi', 'Bogor', 'Batam', 'Pekanbaru', 'Bandar Lampung',
                'Malang', 'Padang', 'Denpasar', 'Samarinda', 'Tasikmalaya', 'Balikpapan',
                'Pontianak', 'Jambi', 'Cimahi', 'Surakarta', 'Manado', 'Yogyakarta'
            ];
        } else {
            $cities = ['Overseas'];
        }

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    /**
     * Generate suggested codes
     */
    public function generateCodes()
    {
        try {
            $boqCode = 'BOQ' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $salesCode = 'SALES' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            return response()->json([
                'success' => true,
                'data' => [
                    'boq_code' => $boqCode,
                    'sales_code' => $salesCode
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating codes: ' . $e->getMessage()
            ], 500);
        }
    }
}