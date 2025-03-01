<?php
declare(strict_types=1);

namespace App\Exceptions\Task;

use Exception;

class TaskNotFoundException extends Exception
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
