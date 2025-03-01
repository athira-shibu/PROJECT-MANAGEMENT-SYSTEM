<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskReportController extends Controller
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

    public function get(int $userId): JsonResponse
    {
        $TotalReports = new Collection();
        
        $user = $this->userRepository->findById($userId);

        if ($user instanceof User === false) {
            throw new UserNotFoundException('user not found');
        }
        
        $projects = $this->projectRepository->getByUser($user);
// dd($projects);
        /** @var \App\Models\Project $project */
        foreach ($projects as $project) {
            $reports = $this->projectRepository->getReports($project);
            $TotalReports->add($reports);
        }

        return new JsonResponse($TotalReports->toArray(), Response::HTTP_OK);
    }
}