<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserCreateRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends Controller
{
    public function register(UserCreateRequest $request): JsonResponse
    {
        
        return new JsonResponse();
    }
}
