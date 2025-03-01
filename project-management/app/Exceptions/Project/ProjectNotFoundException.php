<?php
declare(strict_types=1);

namespace App\Exceptions\Project;

use Exception;

class ProjectNotFoundException extends Exception
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
