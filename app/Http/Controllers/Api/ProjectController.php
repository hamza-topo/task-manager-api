<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Services\ProjectService;
use Illuminate\Http\Request;

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
}
