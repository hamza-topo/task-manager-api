<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    public function getTasks(int $userId)
    {
        try {
            $user = $this->userService->findById($userId);
            return response()->json([
                'status' => 'success',
                'message' => 'List Of Task associated to member found successfully',
                'tasks' => $user->tasks,
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to find user tasks.', $e->getMessage()]);
            return response()->json(['error' => 'Unable to find task of the given user ID.'], 500);
        }
    }
}
