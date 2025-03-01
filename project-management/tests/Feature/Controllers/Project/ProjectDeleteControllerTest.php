<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

class ProjectDeleteControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/projects';

    public function testDeletionIsSuccessful(): void
    {
        $project = $this->createProject();

        $uri = \sprintf('%s/%s', self::URI, $project->id);
        $this->json('DELETE', $uri);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id
        ]);
    }
}
