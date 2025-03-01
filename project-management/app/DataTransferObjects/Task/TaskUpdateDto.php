<?php
declare(strict_types=1);

namespace App\DataTransferObjects\Task;

use App\Constants\Task\TaskTypeEnum;

class TaskUpdateDto
{
    private ?TaskTypeEnum $status;

    private ?string $remarks;

    public function __construct(
        ?TaskTypeEnum $status = null,
        ?string $remarks = null
    ) {
        $this->status = $status;
        $this->remarks = $remarks;
    }

    public function getStatus(): ?TaskTypeEnum
    {
        return $this->status;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }
}
