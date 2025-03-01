<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories\User;

use App\DataTransferObjects\User\UserCreateDto;
use App\Repositories\User\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testUserCreationIsSuccessful(): void
    {
        $createDto = new UserCreateDto(
            'user 1',
            'email1@test.com',
            '123'
        );

        $repository = new UserRepository();

        $result = $repository->create($createDto);

        $this->assertDatabaseHas('users', [
            'name' => 'user 1',
            'email' => 'email@test.com',
        ]);
    }
}