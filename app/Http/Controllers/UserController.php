<?php

namespace App\Http\Controllers;

use View;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;

class UserController extends Controller
{
	protected $userService;

	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
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
		if($request->ajax())
		{
			$users = User::query();
			$result = DataTables::eloquent($users)
			->addColumn('created_at', function($user) {
				return Carbon::parse($user->created_at)->format('d-M-Y');
			})
			->addColumn('actions', function($user) {
				return '
					<div class="dropdown table-action">
						<a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-ellipsis-v"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
						<a 
							id="c_user_edit" 
							class="dropdown-item" 
							href="javascript:void(0);" 
							data-id="'.$user->id.'" 
							data-url="'.route('users.read', ['user_id' => $user->id]).'"
							data-bs-toggle="offcanvas" 
							data-bs-target="#offcanvas_edit">
							<i class="ti ti-edit text-blue"></i> Edit
						</a>
						<a 
							id="c_user_delete" 
							class="dropdown-item" 
							href="javascript:void(0);" 
							data-id="'.$user->id.'" 
							data-url="'.route('users.delete', ['user_id' => $user->id]).'"
							data-bs-toggle="modal" 
							data-bs-target="#delete_user_modal">
							<i class="ti ti-trash text-danger"></i> Delete
						</a>
						</div>
					</div>
				';
				}
			)
			->rawColumns(['actions'])
			->make(true);
			Log::info('Response (users.index): ' . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
			return $result; 
		}

		$roles = Role::all();
		return view('manage-users', compact('roles'));
	}

	public function create(UserRequest $request): JsonResponse
	{
		$user = $this->userService->createUser($request->validated());
		return response()->json([
			'status' => 'success',
			'data' => $user
		], 201);
	}

	public function readAll(): JsonResponse
	{
		$users = $this->userService->getAllUsers();
		return response()->json([
			'status' => 'success',
			'data' => $users
		], 200);
	}

	public function read($user_id): JsonResponse
	{
		$user = $this->userService->getUserById($user_id);
		return response()->json([
			'status' => 'success',
			'data' => $user
		], 200);
	}

	public function update(UserRequest $request, $user_id): JsonResponse
	{
		$validatedData = $request->validated();
		$user = $this->userService->updateUser($user_id, $validatedData);
		return response()->json([
			'status' => 'success',
			'data' => $user
		], 200);
	}

	public function delete($user_id): JsonResponse
	{
		$this->userService->deleteUser($user_id);
		return response()->json([
			'status' => 'success',
			'message' => "User with ID {$user_id} deleted successfully"
		], 200);
	}
}