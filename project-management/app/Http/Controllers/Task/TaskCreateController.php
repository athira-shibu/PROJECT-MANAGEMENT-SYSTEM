<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Constants\Task\TaskTypeEnum;
use App\DataTransferObjects\Task\TaskCreateDto;
use App\Exceptions\Project\ProjectNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Project;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use App\Repositories\Interfaces\Task\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskCreateController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        TaskRepositoryInterface $taskRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
    }

    public function create(TaskCreateRequest $request): JsonResponse
    {
        $project = $this->projectRepository->findById($request->get('project_id'));

        if ($project instanceof Project === false) {
            throw new ProjectNotFoundException('project not found');
        }

        $createDto = new TaskCreateDto(
            $request->get('name'),
            new TaskTypeEnum($request->get('status'))
        );

        $task = $this->taskRepository->create(
            $project,
            $createDto
        );

        return new JsonResponse($task->toArray(), Response::HTTP_CREATED);
    }
}
