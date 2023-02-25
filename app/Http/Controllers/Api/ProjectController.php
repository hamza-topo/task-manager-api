<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function store(StoreProject $request)
    {
        try {
            $project = $this->projectService->create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Project created successfully',
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to create project.'], 500);
        }
    }

    public function update(Request $request, int $projectId)
    {
        try {
            $this->projectService->edit($projectId, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Project updated successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to update project', $e->getMessage()]);
            return response()->json(['error' => 'Unable to update project.'], 500);
        }
    }

    public function destroy(int $projectId)
    {
        try {
            $this->projectService->delete($projectId);
            return response()->json([
                'status' => 'success',
                'message' => 'Project deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to delete project', $e->getMessage()]);
            return response()->json(['error' => 'Unable to delete project.'], 500);
        }
    }

    public function restore(int $projectId)
    {
        try {
            $this->projectService->restore($projectId);
            return response()->json([
                'status' => 'success',
                'message' => 'Project restored successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to restore project', $e->getMessage()]);
            return response()->json(['error' => 'Unable to restore project.'], 500);
        }
    }
}
