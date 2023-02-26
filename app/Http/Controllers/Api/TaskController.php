<?php

namespace App\Http\Controllers\Api;

use App\Enums\Task;
use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function store(Request $request)
    {
        try {
            $task = $this->taskService->create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Task created successfully',
                'task' => $task,
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to create task.', $e->getMessage()]);
            return response()->json(['error' => 'Unable to create task.'], 500);
        }
    }

    public function update(Request $request, $taskId)
    {
        try {
            $task = $this->taskService->edit($taskId, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Task updated successfully',
                'task' => $task
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to update task', $e->getMessage()]);
            return response()->json(['error' => 'Unable to update task.'], 500);
        }
    }

    public function show(int $taskId)
    {
        try {
            $task = $this->taskService->findById($taskId);
            return response()->json([
                'status' => 'success',
                'message' => 'Task found successfully',
                'task' => $task,
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to find task.', $e->getMessage()]);
            return response()->json(['error' => 'Unable to find task.'], 500);
        }
    }

    public function destroy(int $taskId)
    {
        try {
            $this->taskService->delete($taskId);
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to delete task', $e->getMessage()]);
            return response()->json(['error' => 'Unable to delete task.'], 500);
        }
    }

    public function restore(int $taskId)
    {
        try {
            $this->taskService->restore($taskId);
            return response()->json([
                'status' => 'success',
                'message' => 'Task restored successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to restore Task', $e->getMessage()]);
            return response()->json(['error' => 'Unable to restore task.'], 500);
        }
    }

    public function getAll()
    {
        try {

            return response()->json([
                'status' => 'success',
                'tasks' => $this->taskService->getAll(),
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to get the list of projects', $e->getMessage()]);
            return response()->json(['error' => 'Unable to get the list of projects'], 500);
        }
    }

    public function paginate(int $perPage = Task::PAGINATE)
    {
        $tasks = $this->taskService->paginate($perPage);
        try {
            return response()->json([
                'status' => 'success',
                'tasks' => $tasks->toArray(),
                'meta' => [
                    'current_page' => $tasks->currentPage(),
                    'from' => $tasks->firstItem(),
                    'last_page' => $tasks->lastPage(),
                    'per_page' => $tasks->perPage(),
                    'to' => $tasks->lastItem(),
                    'total' => $tasks->total(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to get the list of tasks with pagination', $e->getMessage()]);
            return response()->json(['error' => 'Unable to get the list of tasks with pagination'], 500);
        }
    }

    public function getTaskByStatus(int $status = Task::PENDING)
    {
        try {
            $tasks = $this->taskService->getTasksByStatus($status);
            return response()->json([
                'status' => 'success',
                'message' => 'Task listed successfully',
                'tasks'  => $tasks
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to get Tasks with The given status:' . $status, $e->getMessage()]);
            return response()->json(['error' => 'Unable to get Tasks with The given status:' . $status], 500);
        }
    }
}
