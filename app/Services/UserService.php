<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements Service
{

    public function create(array $user = []): User
    {
        return User::create($user);
    }

    public function edit(int $userId, array $user = []): User
    {
        $oldUser  = $this->findById($userId);
        $oldUser->update($user);
        $oldUser->refresh();
        return $oldUser;
    }

    public function findById(int $userId): User
    {
        return User::findOrFail($userId);
    }

    public function getAll(): Collection
    {
        return User::OrderBy('id', 'desc')->get();
    }

    public function getUsersById(array $usersIds = []):Collection
    {
        return User::whereIn('id',$usersIds)->get();
    }

    public function login(Request $request): mixed
    {
        return   Auth::attempt($request->only('email', 'password'));
    }

    public function formatUser(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
    }
}
