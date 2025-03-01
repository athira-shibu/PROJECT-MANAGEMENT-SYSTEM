<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Tests\Traits\ModelFactoryTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutControllerTest extends TestCase
{
    private const URI = 'api/logout';

    use ModelFactoryTrait, RefreshDatabase, WithoutMiddleware;

    public function testLogoutIsSuccessful(): void
    {
        $user = $this->createUser();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out']);
    }
}