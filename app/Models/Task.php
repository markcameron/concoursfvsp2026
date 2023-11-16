<?php

namespace App\Models;

use App\Enums\StatusTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'deadline',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'datetime',
        'status' => StatusTask::class,
    ];

    /**
     * Get all of the users for the task.
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable');
    }

    /**
     * Get all of the committees that are assigned this tasks.
     */
    public function committees(): MorphToMany
    {
        return $this->morphedByMany(Committee::class, 'taskable');
    }

    public function complete(): bool
    {
        return $this->status === StatusTask::COMPLETE;
    }

    public function deadlineColor(): string
    {
        if ($this->complete()) {
            return 'gray';
        }

        return $this->deadline->isAfter(now())
            ? 'success'
            : 'danger';
    }
}
