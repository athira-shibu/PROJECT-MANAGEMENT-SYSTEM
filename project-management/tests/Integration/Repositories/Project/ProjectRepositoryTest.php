<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories\Project;

use App\DataTransferObjects\Project\ProjectCreateDto;
use App\Repositories\Project\ProjectRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

class ProjectRepositoryTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase;

    public function testCreationIsSuccessful(): void
    {
        $user = $this->createUser();

        $createDto = new ProjectCreateDto(
            'project one'
        );

        $repository = new ProjectRepository();

        $result = $repository->create($user, $createDto);

        $this->assertDatabaseHas('projects', [
            'name' => 'project one',
            'user_id' => $user->getAttribute('id')
        ]);
    }

    public function testUpdateIsSuccessful(): void
    {
        $user = $this->createUser();

        $project = $this->createProject(
            $user,
            'project one'
        );

        $updateDto = new ProjectCreateDto('project 2');

        $repository = new ProjectRepository();

        $result = $repository->update($project, $updateDto);

        $this->assertDatabaseHas('projects', [
            'name' => 'project 2'
        ]);
    }

    public function testFindByIdIsSuccessful(): void
    {
        $project = $this->createProject();

        $repository = new ProjectRepository();

        $result = $repository->findById($project->id);

        $expected = [
            'id' => $project->id
        ];

        $this->assertEquals($expected['id'], $result->id);

    }

    public function testDeletionIsSuccessful(): void
    {
        $project = $this->createProject();

        $repository = new ProjectRepository();

        $repository->delete($project);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id
        ]);
    }

    public function testFetchProjectsByUserIsSuccessful(): void
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser(
            'user 2',
            'user2@test.com'
        );

        $project1 = $this->createProject($user1);
        $project2 = $this->createProject($user1);
        $project3 = $this->createProject($user2);

        $repository = new ProjectRepository();

        $result = $repository->getByUser($user1);

        $expected = [
            $project1->toArray(),
            $project2->toArray()
        ];

        self::assertCount(2, $result);
    }

    public function testGetReportIsSuccessful(): void
    {
        $user = $this->createUser(
            'miya',
            'usernew@test.com'
        );

        $project1 = $this->createProject();
        $task =$this->createTask(
            $project1
        );

        $taskRemarks = $this->createTaskRemarks(
            $task
        );

        $repository = new ProjectRepository();

        $result = $repository->getReports($project1);
        
        $this->assertNotEmpty($result);
    }
}
