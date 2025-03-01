<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories\Task;

use App\Constants\Task\TaskTypeEnum;
use App\DataTransferObjects\Task\TaskCreateDto;
use App\DataTransferObjects\Task\TaskUpdateDto;
use App\Repositories\Task\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

class TaskRepositoryTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase;

    public function testCreationIsSuccessful(): void
    {
        $project = $this->createProject();

        $createDto = new TaskCreateDto(
            'task 1',
            TaskTypeEnum::COMPLETED(),
            'remarks'
        );

        $repository = new TaskRepository();

        $result = $repository->create(
            $project,
            $createDto
        );

        $this->assertDatabaseHas('tasks', [
            'name' => 'task 1',
            'status' => TaskTypeEnum::COMPLETED,
            'remarks' => 'remarks',
            'project_id' => $project->id
        ]);
    }

    public function testFindTaskIsSuccessful(): void
    {
        $task = $this->createTask();

        $repository = new TaskRepository();

        $result = $repository->findById($task->id);

        $expected = [
            'id' => $task->id
        ];

        $this->assertEquals($expected['id'], $result->id);
    }

    public function testStatusUpdateIsSuccessful(): void
    {
        $project = $this->createProject();

        $task = $this->createTask(
            $project,
            'task test',
            TaskTypeEnum::COMPLETED()
        );

        $repository = new TaskRepository();

        $updateDto = new TaskUpdateDto(
            TaskTypeEnum::PENDING(),
            'iam remark'
        );

        $repository->updateStatus($task, $updateDto);

        $this->assertDatabaseHas('tasks', [
            'status' => 'pending',
            'remarks' => 'iam remark'
        ]);
    }
}
