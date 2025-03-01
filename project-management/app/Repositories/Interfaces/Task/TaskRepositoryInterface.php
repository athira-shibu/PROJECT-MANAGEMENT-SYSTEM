<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces\Task;

use App\DataTransferObjects\Task\TaskCreateDto;
use App\DataTransferObjects\Task\TaskUpdateDto;
use App\Models\Project;
use App\Models\Task;

interface TaskRepositoryInterface
{
    public function create(Project $project, TaskCreateDto $createDto): Task;

    public function findById(int $id): ?Task;

    public function updateStatus(Task $task, TaskUpdateDto $updateDto): Task;
}