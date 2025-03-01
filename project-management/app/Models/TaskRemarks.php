<?php

namespace App\Models;

use App\Constants\Task\TaskTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * 
 * @property TaskTypeEnum $status
 * @property Date $date
 * @property string $remarks
 */
class TaskRemarks extends Model
{
    use HasFactory;

    protected $table = 'task_remarks';

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function getTask(): Task
    {
        return $this->getRelationValue('task');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getAttribute('id'),
            'status' => $this->getAttribute('name'),
            'remarks' => $this->getAttribute('remarks'),
            'date' => $this->getUser()->toArray(),
        ];
    }
}
