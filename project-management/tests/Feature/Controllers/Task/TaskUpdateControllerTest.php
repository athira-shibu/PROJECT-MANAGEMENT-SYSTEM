<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\Task;

use App\Constants\Task\TaskTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class TaskUpdateControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/tasks';

    public function testUpdateIsSuccessful(): void
    {
        $project = $this->createProject();
        $task = $this->createTask(
            $project,
            'task 3',
            TaskTypeEnum::COMPLETED()
        );

        $data = [
            'status' => 'pending',
            'remarks' => 'iam your remarks'
        ];

        $uri = \sprintf('%s/%s', self::URI, $task->id);

        $this->json('PUT', $uri, $data);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending',
            'remarks' => 'iam your remarks'
        ]);
    }
}
