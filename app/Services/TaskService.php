<?php

namespace App\Services;

use App\Enums\Task as EnumsTask;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService implements Service
{
    public function create(array $task = []):Task
    {
        return Task::create($task);
    }

    public function edit(int $taskId, array $task = []):Task
    {
        $oldTask = $this->findById($taskId);
        $oldTask->update($task);
        $oldTask->refresh();
        return $oldTask;
    }

    public function findById(int $taskId): Task
    {
        return Task::with('user')->with('project')->findOrFail($taskId);
    }

    public function delete(int $taskId):bool
    {
        return Task::destroy($taskId);
    }

    public function restore(int $taskId)
    {
        return Task::withTrashed()->find($taskId)->restore();
    }

    public function getAll(): Collection
    {
        return Task::OrderBy('id', 'desc')->with('user')->with('project')->get();
    }

    public function paginate(int $perPage = EnumsTask::PAGINATE)
    {
        return Task::paginate($perPage);
    }

    public function getTasksByStatus(int $status):Collection
    {
        return Task::where('status',$status)->get();
    }
}
