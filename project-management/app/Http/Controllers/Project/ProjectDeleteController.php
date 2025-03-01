<?php
declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectDeleteController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }

    public function delete(int $id): JsonResponse
    {
        $project = $this->projectRepository->findById($id);

        if ($project instanceof Project === false) {
            throw new ProjectNotFoundException('project not found');
        }

        $this->projectRepository->delete($project);

        return $this->sendNoContentJsonResponse();
    }
}