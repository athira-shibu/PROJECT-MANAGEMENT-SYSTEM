<?php
declare(strict_types=1);

namespace Tests\Traits;

use App\Models\User;

trait ModelFactoryTrait
{
    public function createUser(
        ?string $name = null,
        ?string $email = null,
        ?string $password = null
    ): User {
        $user = new User();

        $user->setAttribute('name', $name ?? 'user a');
        $user->setAttribute('email', $email ?? 'usera@test.com');
        $user->setAttribute('password', $password ?? '1234');

        $user->save();

        return $user;
    }
}