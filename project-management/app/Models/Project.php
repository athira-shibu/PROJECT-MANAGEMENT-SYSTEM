<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * 
 * @property string $name
 */
class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getUser(): User
    {
        return $this->getRelationValue('user');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getAttribute('id'),
            'name' => $this->getAttribute('name'),
            'user' => $this->getUser()->toArray(),
        ];
    }
}
