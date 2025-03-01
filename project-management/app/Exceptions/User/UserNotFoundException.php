<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use Exception;

class UserNotFoundException extends Exception
{
    /**
     * {@inheritdoc}
     */
    public function getErrorCode(): int
    {
        return  0;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorSubCode(): int
    {
        return 1;
    }
}
