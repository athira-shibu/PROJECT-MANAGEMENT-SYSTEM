<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * 
 * @property string $name
 * @property string $status
 */
class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getProject(): Project
    {
        return $this->getRelationValue('project');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getAttribute('id'),
            'name' => $this->getAttribute('name'),
            'status' => $this->getAttribute('status'),
            'project' => $this->getProject()->toArray(),
        ];
    }
}
