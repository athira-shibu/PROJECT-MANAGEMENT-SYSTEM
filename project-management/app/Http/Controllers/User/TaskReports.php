<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskReports extends Controller
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }

    public function get(int $userId): JsonResponse
    {
        
        return new JsonResponse();
    }
}