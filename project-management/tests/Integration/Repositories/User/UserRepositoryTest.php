<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories\User;

use App\DataTransferObjects\User\UserCreateDto;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

class UserRepositoryTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase;

    public function testUserCreationIsSuccessful(): void
    {
        $createDto = new UserCreateDto(
            'user 1',
            'email1@test.com',
            '123'
        );

        $repository = new UserRepository();

        $repository->create($createDto);

        $this->assertDatabaseHas('users', [
            'name' => 'user 1',
            'email' => 'email@test.com',
        ]);
    }

    public function testFindOneByIdIsSuccess(): void
    {
        $user = $this->createUser();
        $repository = new UserRepository();

        $response = $repository->findById($user->id);

        $expected = [
            'id' => $user->id
        ];

        $this->assertEquals($expected['id'], $response->id);
    }
}
