<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces\Project;

use App\DataTransferObjects\Project\ProjectCreateDto;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    public function create(User $user, ProjectCreateDto $createDto): Project;

    public function update(Project $project, ProjectCreateDto $updateDto): Project;

    public function findById(int $id): ?Project;

    public function delete(Project $project): void;

    public function getByUser(User $user): Collection;

    public function getReports(Project $project): Project;
}
