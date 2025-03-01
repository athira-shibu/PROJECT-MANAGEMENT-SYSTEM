<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\User;

use App\DataTransferObjects\User\UserCreateDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

final class RegisterControllerTest extends TestCase
{
    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    private const URI = 'api/register';

    public function testUserRegisterIsSuccessful(): void
    {
        $data = [
            'name' => 'user 2',
            'email' => 'testmail@test.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $this->json('POST', self::URI, $data);

        $this->assertDatabaseHas('users', [
            'name' => 'user 2',
            'email' => 'testmail@test.com'
        ]);
    }
}
