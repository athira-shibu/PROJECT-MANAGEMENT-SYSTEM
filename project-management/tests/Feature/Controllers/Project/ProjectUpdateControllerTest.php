<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class ProjectUpdateControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/projects';

    public function testUpdateIsSuccessful(): void
    {
        $user = $this->createUser();

        $project = $this->createProject($user, 'dummy project');

        $data = [
            'name' => 'modified'
        ];

        $uri = \sprintf('%s/%s', self::URI, $project->id);
        $this->json('PUT', $uri, $data);

        $this->assertDatabaseHas('projects', [
            'name' => 'modified',
            'user_id' => $user->id
        ]);
    }
}
