<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(): User;
}