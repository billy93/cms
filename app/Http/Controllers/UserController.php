<?php

namespace App\Http\Controllers;

use View;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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

	public function create(UserRequest $request): JsonResponse
	{
		$user = $this->userService->createUser($request->validated());
		return response()->json([
			'status' => 'success',
			'data' => $user
		], 201);
	}

	public function getAll(): JsonResponse
	{
		$users = $this->userService->getAllUsers();
		return response()->json([
			'status' => 'success',
			'data' => $users
		], 200);
	}

	public function getById($user_id): JsonResponse
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

	public function index()
	{
		$users = User::all();
		return response()->json($users);
	}

	public function manageUsers()
	{
    $users = User::orderBy('created_at', 'desc')->paginate(10);
    return view('manage-users', compact('users'));
	}

	/**
	 * Retrieve paginated users with ordering, excluding the password field,
	 * and pass the data to the manage-users view.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\View\View
	 */
	public function getUsers(Request $request)
	{
		$page = $request->query('page', 1);   
		$size = $request->query('size', 10); 
		$orderBy = $request->query('orderBy', 'id');  
		$orderDir = $request->query('orderDir', 'desc');  
		$total = User::count(); 
		$users = User::orderBy($orderBy, $orderDir)
			->skip(($page - 1) * $size)
			->take($size)
			->get()
			->makeHidden(['password']);
		$data = [
			'curPage' => $page,
			'size' => $size,
			'orderBy' => $orderBy,
			'orderDir' => $orderDir,
			'data' => $users,
			'totalData' => $total,
			'totalPage' => ceil($total / $size)
		];
		
		Log::debug("CALCULATED PARAMS: " . json_encode($data, JSON_PRETTY_PRINT));
		
		return view("manage-users", $data);
	}
}