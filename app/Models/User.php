<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use HasSuperAdmin;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_seen',
        'first_name',
        'last_name',
        'alias',
        'email',
        'email_verified_at',
        'password',
        'create_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'create_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasVerifiedEmail();
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Determine if the user has visited the application recently.
     */
    public function hasLoggedInPreviously(): bool
    {
        return $this->last_seen !== null;
    }

    /**
     * Get all of the events that are assigned this user.
     */
    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'userable');
    }

    /**
     * Get all of the committees that are assigned this user.
     */
    public function committees(): MorphToMany
    {
        return $this->morphedByMany(Committee::class, 'userable');
    }

    /**
     * Get all of the tasks that are assigned this user.
     */
    public function tasks(): MorphToMany
    {
        return $this->morphedByMany(Task::class, 'userable');
    }

    /**
     * Get the user's first name.
     */
    protected function alias(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtoupper($value),
        );
    }
}
