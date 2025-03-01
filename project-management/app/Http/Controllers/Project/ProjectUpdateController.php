<?php
declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\DataTransferObjects\Project\ProjectCreateDto;
use App\Exceptions\Project\ProjectNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\Project;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectUpdateController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }

    public function update(int $id, ProjectUpdateRequest $request): JsonResponse
    {
        $project = $this->projectRepository->findById($id);

        if ($project instanceof Project === false) {
            throw new ProjectNotFoundException('project not found');
        }

        $updateDto = new ProjectCreateDto(
            $request->get('name')
        );

        $project = $this->projectRepository->update(
            $project,
            $updateDto
        );

        return new JsonResponse($project->toArray(), Response::HTTP_OK);
    }
}
