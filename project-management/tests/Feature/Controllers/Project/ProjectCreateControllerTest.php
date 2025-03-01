<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class ProjectCreateControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/projects';

    public function testCreationIsSuccessful(): void
    {
        $user = $this->createUser();

        $data = [
            'name' => 'project two',
            'user_id' => $user->id
        ];

        $this->json('POST', self::URI, $data);

        $this->assertDatabaseHas('projects', [
            'name' => 'project two',
            'user_id' => $user->id
        ]);
    }
}