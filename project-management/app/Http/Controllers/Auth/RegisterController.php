<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DataTransferObjects\User\UserCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserCreateRequest;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register(UserCreateRequest $request): JsonResponse
    {
        $createDto = new UserCreateDto(
            $request->get('name'),
            $request->get('email'),
            $request->get('password')
        );

        $user = $this->userRepository->create($createDto);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }
}
