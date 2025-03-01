<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;

class LoginControllerTest extends TestCase
{
    private const URI = 'api/login';

    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    public function testLoginSuccessfully(): void
    {
        $user = $this->createUser(
            'name',
            'test@test.com',
            '123456'
        );

        $data = [
            'email' => 'test@test.com',
            'password' => '123456'
        ];

        $response = $this->json('POST', self::URI, $data);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }
}