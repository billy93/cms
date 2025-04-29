<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Exceptions\CustomApiException;

class UserService
{
    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'location' => $data['location'],
            'status' => $data['status'] ?? 'active',
            'role_id' => $data['role_id'],
        ]);

        return $user->load('role');
    }

    public function getAllUsers()
    {
        return User::with('role')->get();
    }

    public function getUserById($id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            throw new CustomApiException("User with ID {$id} not found", 404);
        }

        return $user;
    }

    public function updateUser($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            throw new CustomApiException("User with ID {$id} not found", 404);
        }

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'location' => $data['location'],
            'status' => $data['status'],
            'role_id' => $data['role_id'],
        ];

        if (isset($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return $user->fresh('role');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new CustomApiException("User with ID {$id} not found", 404);
        }

        $user->delete();
    }
}
