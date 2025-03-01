<?php
declare(strict_types=1);

namespace App\DataTransferObjects\Task;

use App\Constants\Task\TaskTypeEnum;

class TaskCreateDto
{
    private string $name;

    private TaskTypeEnum $status;

    private ?string $remarks;

    public function __construct(
        string $name,
        TaskTypeEnum $status,
        ?string $remarks = null
    ) {
        $this->name = $name;
        $this->status = $status;
        $this->remarks = $remarks;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): TaskTypeEnum
    {
        return $this->status;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }
}
