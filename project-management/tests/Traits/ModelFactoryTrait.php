<?php
declare(strict_types=1);

namespace Tests\Traits;

use App\Models\Project;
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

    public function createProject(
        ?User $user = null,
        ?string $name = null,
    ): Project {
        $project = new Project();
        $user = $user !== null ? $user : $this->createUser();

        $project->setAttribute('name', $name ?? 'project one');

        $project->user()->associate($user);

        $project->save();

        return $project;
    }
}