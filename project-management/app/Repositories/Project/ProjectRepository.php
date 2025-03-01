<?php
declare(strict_types=1);

namespace App\Repositories\Project;

use App\DataTransferObjects\Project\ProjectCreateDto;
use App\Models\Project;
use App\Models\User;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

final class ProjectRepository implements ProjectRepositoryInterface
{
    public function create(User  $user, ProjectCreateDto $createDto): Project
    {
        $project = new Project();

        $project->setAttribute('name', $createDto->getName());

        $project->user()->associate($user);

        $project->save();

        return $project;
    }

    public function update(Project $project, ProjectCreateDto $updateDto): Project
    {
        $project->setAttribute('name', $updateDto->getName());

        $project->save();

        return $project;
    }

    public function findById(int $id): ?Project
    {
        return (new Project())
            ->where('id', '=', $id)
            ->first();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }

    public function getByUser(User $user): Collection
    {
        return (new Project())
            ->where('user_id', '=', $user->id)
            ->get();
    }

    public function getReports(Project $project): Project
    {
        return (new Project())
            ->select('projects.*','tasks.*', 'task_remarks.*')
            ->leftJoin(
                'tasks',
                'tasks.project_id',
                '=',
                'projects.id'
            )
            ->leftJoin(
                'task_remarks',
                'task_remarks.task_id',
                '=',
                'tasks.id'
            )
            ->where('projects.id', '=', $project->id)
            ->first();
    }
}