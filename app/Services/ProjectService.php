<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectService implements Service
{

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

    public function restore(int $projectId):bool 
    {
       return Project::withTrashed()->find($projectId)->restore();
    }

    public function getAll(): Collection
    {
        return Project::orderBy('id', 'des')->get();
    }
}
