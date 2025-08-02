<?php

namespace App\Http\Controllers;

use View;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
// use App\Models\Role;
// use App\Models\User;
// use App\Http\Requests\UserRequest;
use App\Http\Services\BOQService;

class BOQController extends Controller
{
	protected $boqService;

	public function __construct(BOQService $boqService)
	{
		$this->boqService = $boqService;
	}

	/**
	 * Retrieve paginated users with ordering, excluding the password field,
	 * and pass the data to the manage-users view.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
		
		return view('boq-page');
	}

	
}