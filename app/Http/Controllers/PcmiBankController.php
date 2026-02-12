<?php

namespace App\Http\Controllers;

use App\Http\Services\PcmiBankService;
use App\Models\PcmiBank;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PcmiBankController extends Controller
{
    protected $pcmiBankService;

    public function __construct(PcmiBankService $pcmiBankService)
    {
        $this->pcmiBankService = $pcmiBankService;
    }

    /**
     * Display pcmi bank listing (for DataTables).
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $pcmiBanks = PcmiBank::with(['bank']);

            return DataTables::eloquent($pcmiBanks)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereHas('bank', fn($bk) =>
                                $bk->whereRaw('LOWER(bank_name) LIKE ?', ["%{$search}%"])
                                  ->orWhereRaw('LOWER(bank_code) LIKE ?', ["%{$search}%"])
                            )
                            ->orWhereRaw('LOWER(account_no) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(branch) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(holder_name) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->addColumn('bank_name', fn($p) => $p->bank->bank_name ?? '-')
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="#"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('pcmibanks.index');
    }

    /**
     * Read all pcmi banks (JSON).
     */
    public function readAll(Request $request): JsonResponse
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $banks = $this->pcmiBankService->getAllPcmiBanks();
                return response()->json([
                    'success' => true,
                    'data' => $banks
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to fetch PCMI Banks'
                ], 500);
            }
        }
        abort(404);
    }

    /**
     * Read a single pcmi bank by ID.
     */
    public function read(Request $request, $pcmibank_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $bank = $this->pcmiBankService->getPcmiBankById($pcmibank_id);
                return response()->json([
                    'success' => true,
                    'data' => $bank
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load PCMI Bank'
                ], 500);
            }
        }

        $bank = $this->pcmiBankService->getPcmiBankById($pcmibank_id);
        return view('pcmibanks.detail', compact('bank'));
    }
}
