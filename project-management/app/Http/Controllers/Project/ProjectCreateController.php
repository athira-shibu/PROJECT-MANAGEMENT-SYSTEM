<?php
declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\DataTransferObjects\Project\ProjectCreateDto;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectCreateRequest;
use App\Models\User;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectCreateController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    private UserRepositoryInterface $userRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    public function create(ProjectCreateRequest $request): JsonResponse
    {
        $user = $this->userRepository->findById($request->get('user_id'));

        if ($user instanceof User === false) {
            throw new UserNotFoundException('user not found');
        }

        $createDto = new ProjectCreateDto(
            $request->get('name')
        );

        $project = $this->projectRepository->create($user, $createDto);

        return new JsonResponse($project->toArray(), Response::HTTP_CREATED);
    }
}
