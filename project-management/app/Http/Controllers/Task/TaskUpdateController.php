<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Constants\Task\TaskTypeEnum;
use App\DataTransferObjects\Task\TaskUpdateDto;
use App\Exceptions\Task\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;
use App\Repositories\Interfaces\Task\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskUpdateController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function update(int $id, TaskUpdateRequest $request): JsonResponse
    {
        $task = $this->taskRepository->findById($id);

        if ($task instanceof Task === false) {
            throw new TaskNotFoundException('task not found');
        }

        $updateDto = new TaskUpdateDto(
            new TaskTypeEnum($request->get('status')),
            $request->get('remarks')
        );

        $task = $this->taskRepository->updateStatus($task, $updateDto);

        return new JsonResponse($task->toArray(), Response::HTTP_OK);
    }
}
