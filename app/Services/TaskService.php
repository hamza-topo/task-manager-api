<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService implements Service
{
    public function create(array $task = [])
    {
        return Task::create($task);
    }

    public function edit(int $taskId, array $task = [])
    {
        $oldTask = $this->findById($taskId);
        $oldTask->update($task);
        $oldTask->refresh();
        return $oldTask;
    }

    public function findById(int $taskId): Task
    {
        return Task::findOrFail($taskId);
    }

    public function getAll(): Collection
    {
        return Task::OrderBy('updated_at', 'desc')->get();
    }
}
