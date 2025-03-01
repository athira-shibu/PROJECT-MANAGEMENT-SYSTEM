<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class TaskCreateControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/tasks';

    public function testCreateIsSuccessful(): void
    {
        $project = $this->createProject();

        $data = [
            'name' => 'task one',
            'status' => 'completed',
            'project_id' => $project->id
        ];

        $this->json('POST', self::URI, $data);

        $this->assertDatabaseHas('tasks', [
            'name' => 'task one',
            'status' => 'completed',
            'project_id' => $project->id
        ]);
    }
}