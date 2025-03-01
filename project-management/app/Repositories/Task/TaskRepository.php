<?php
declare(strict_types=1);

namespace App\Repositories\Task;

use App\DataTransferObjects\Task\TaskCreateDto;
use App\DataTransferObjects\Task\TaskUpdateDto;
use App\Models\Project;
use App\Models\Task;
use App\Repositories\Interfaces\Task\TaskRepositoryInterface;

final class TaskRepository implements TaskRepositoryInterface
{
    public function create(Project $project, TaskCreateDto $taskCreateDto): Task
    {
        $task = new Task();

        $task->setAttribute('name', $taskCreateDto->getName());
        $task->setAttribute('status', $taskCreateDto->getStatus()->getValue());
        $task->setAttribute('remarks', $taskCreateDto->getRemarks());

        $task->project()->associate($project);

        $task->save();

        return $task;
    }

    public function findById(int $id): ?Task
    {
        return (new Task())
            ->where('id', '=', $id)
            ->first();
    }

    public function updateStatus(Task $task, TaskUpdateDto $updateDto): Task
    {
        $task->setAttribute('status', $updateDto->getStatus());
        $task->setAttribute('remarks', $updateDto->getRemarks());
        
        $task->save();

        return $task;
    }
}
