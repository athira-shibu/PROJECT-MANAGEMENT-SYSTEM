<?php
declare(strict_types=1);

namespace App\Constants\Task;

use MyCLabs\Enum\Enum;

/**
 * @method static TaskTypeEnum PENDING()
 * @method static TaskTypeEnum PROGRESS()
 * @method static TaskTypeEnum COMPLETED()
 */
class TaskTypeEnum extends Enum
{
    public const PENDING = 'pending';

    public const PROGRESS = 'progress';

    public const COMPLETED = 'completed';
}
