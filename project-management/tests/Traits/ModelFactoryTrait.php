<?php
declare(strict_types=1);

namespace Tests\Traits;

use App\Constants\Task\TaskTypeEnum;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskRemarks;
use App\Models\User;
use DateTime;

trait ModelFactoryTrait
{
    public function createUser(
        ?string $name = null,
        ?string $email = null,
        ?string $password = null
    ): User {
        $user = new User();

        $user->setAttribute('name', $name ?? 'user a');
        $user->setAttribute('email', $email ?? 'usera@test.com');
        $user->setAttribute('password', $password ?? '1234');

        $user->save();

        return $user;
    }

    public function createProject(
        ?User $user = null,
        ?string $name = null,
    ): Project {
        $project = new Project();
        $user = $user !== null ? $user : $this->createUser();

        $project->setAttribute('name', $name ?? 'project one');

        $project->user()->associate($user);

        $project->save();

        return $project;
    }

    public function createTask(
        ?Project $project = null,
        ?string $name = null,
        ?TaskTypeEnum $status = null
    ) : Task {
        $task = new Task();

        $project = $project !== null ? $project : $this->createProject();

        $task->setAttribute('name', $name ?? 'task one');
        $task->setAttribute('status', $status ?? 'pending');

        $task->project()->associate($project);

        $task->save();

        return $task;
    }

    public function createTaskRemarks(
        ?Task $task = null,
        ?TaskTypeEnum $status = null,
        ?DateTime $date = null,
        ?string $remarks = null
    ): TaskRemarks {
        $task = $task !== null ? $task : $this->createTask();

        $taskRemarks = new TaskRemarks();

        $taskRemarks->setAttribute('status', $status ?? 'pending');
        $taskRemarks->setAttribute('remarks', $remarks ?? 'no remarks');
        $taskRemarks->setAttribute('date', '12/09/23');

        $taskRemarks->task()->associate($task);

        $taskRemarks->save();

        return $taskRemarks;
    }
}