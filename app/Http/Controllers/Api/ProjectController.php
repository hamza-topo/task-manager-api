<?php

namespace App\Http\Controllers\Api;

use App\Enums\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectMembersRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\StoreProject;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function __construct(protected ProjectService $projectService)
    {
    }

    public function store(ProjectRequest $request)
    {
        try {
            $project = $this->projectService->create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Project created successfully',
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to create project.', $e->getMessage()]);
            return response()->json(['error' => 'Unable to create project.'], 500);
        }
    }

    public function update(ProjectRequest $request, int $projectId)
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

    public function addMembers(ProjectMembersRequest $request, int $projectId)
    {
        try {
            $this->projectService->attachMembersToProject($projectId, $request->members);
            return response()->json([
                'status' => 'success',
                'message' => 'Members attached to the project successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to attach members to project', $e->getMessage()]);
            return response()->json(['error' => 'Unable to attach members to project'], 500);
        }
    }

    public function removeMembers(ProjectMembersRequest $request, int $projectId)
    {
        try {
            $this->projectService->detachMembersFromProject($projectId, $request->members);
            return response()->json([
                'status' => 'success',
                'message' => 'Members detached from the project successfully',
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to detach members from project', $e->getMessage()]);
            return response()->json(['error' => 'Unable to detach members from project'], 500);
        }
    }

    public function getAll()
    {
        try {

            return response()->json([
                'status' => 'success',
                'projects' => ProjectResource::collection($this->projectService->getAll()),
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to get the list of projects', $e->getMessage()]);
            return response()->json(['error' => 'Unable to get the list of projects'], 500);
        }
    }

    public function paginate(int $perPage = Project::PAGINATE)
    {
        $projects = $this->projectService->paginate($perPage);
        $listProjects = $projects->map(function ($project) {
            return new ProjectResource($project);
        });
        try {
            return response()->json([
                'status' => 'success',
                'projects' => $listProjects->toArray(),
                'meta' => [
                    'current_page' => $projects->currentPage(),
                    'from' => $projects->firstItem(),
                    'last_page' => $projects->lastPage(),
                    'per_page' => $projects->perPage(),
                    'to' => $projects->lastItem(),
                    'total' => $projects->total(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::info(['Unable to get the list of projects', $e->getMessage()]);
            return response()->json(['error' => 'Unable to get the list of projects'], 500);
        }
    }
}
