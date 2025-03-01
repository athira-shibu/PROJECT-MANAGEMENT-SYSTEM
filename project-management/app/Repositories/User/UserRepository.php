<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\DataTransferObjects\User\UserCreateDto;
use App\Models\User;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    public function create(UserCreateDto $createDto): User
    {
        $user = new User();

        $user->setAttribute('name', $createDto->getName());
        $user->setAttribute('email', $createDto->getEmail());
        $user->setAttribute('password', $createDto->getPassword());

        $user->save();

        return $user;
    }
}