<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces\User;

use App\DataTransferObjects\User\UserCreateDto;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(UserCreateDto $createDto): User;
}