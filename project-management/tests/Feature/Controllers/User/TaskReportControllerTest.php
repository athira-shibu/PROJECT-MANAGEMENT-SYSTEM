<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class TaskReportControllerTest extends TestCase
{
    use ModelFactoryTrait, WithoutMiddleware, RefreshDatabase;

    private const URI = 'api/reports';

    public function testGetReportsIsSuccessful(): void
    {
        $user = $this->createUser(
            'miya',
            'usernew@test.com'
        );

        $project1 = $this->createProject($user);
        $task =$this->createTask(
            $project1
        );

        $taskRemarks = $this->createTaskRemarks(
            $task
        );

        $uri = \sprintf('%s/%s', self::URI, $user->id);
        $response = $this->json('GET', $uri);
        // dd($response);
        $response->assertStatus(Response::HTTP_OK);
    }
}