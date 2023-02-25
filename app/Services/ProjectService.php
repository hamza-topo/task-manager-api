<?php

namespace App\Services;

use App\Enums\Project as EnumsProject;
use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectService implements Service
{

    public function __construct(protected UserService $userService)
    {
    }

    public function create(array $project = []): Project
    {
        return Project::create($project);
    }

    public function edit(int $projectId, array $project = []): Project
    {
        $oldProject = $this->findById($projectId);
        $oldProject->update($project);
        $oldProject->refresh();
        return $oldProject;
    }

    public function findById(int $projectId)
    {
        return Project::findOrFail($projectId);
    }

    public function delete(int $projectId): bool
    {
        return Project::destroy($projectId);
    }

    public function restore(int $projectId): bool
    {
        return Project::withTrashed()->find($projectId)->restore();
    }

    public function getAll(): Collection
    {
        return Project::orderBy('id', 'desc')->with('users')->get();
    }

    public function paginate(int $perPage = EnumsProject::PAGINATE)
    {
        return Project::paginate($perPage);
    }

    public function attachMembersToProject(int $projectId, array $memeberIds = [])
    {
        $project = $this->findById($projectId);
        $memebers   = $this->userService->getUsersById($memeberIds);
        return $project->users()->attach($memebers, ['project_id' => $project->id]);
    }

    public function detachMembersFromProject(int $projectId, array $memeberIds = [])
    {
        $project = $this->findById($projectId);
        return  $project->users()->detach($memeberIds);
    }
}
