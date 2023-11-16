<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Committee extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'color',
    ];

    /**
     * Get all of the tags for the post.
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable')->withPivot('role');
    }

    /**
     * Get all of the tags for the post.
     */
    public function tasks(): MorphToMany
    {
        return $this->morphToMany(Task::class, 'taskable');
    }

    public function colors(): array
    {
        $colors = array_keys(Color::all());
        sort($colors);
        return array_combine($colors, array_map(fn ($item) => ucfirst($item), $colors));
    }

    public function badge(): string
    {
        if (!in_array($this->color, array_keys(Color::all()))) {
            return '<span>' . strtolower($this->name) . '</span>';
        }
        $cssVariables = \Illuminate\Support\Arr::toCssStyles([
            \Filament\Support\get_color_css_variables(Color::all()[$this->color], shades: [50, 400, 600]) => true
        ]);

        $classes = implode(' ', [
            'fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2',
            'min-w-[theme(spacing.6)] py-1',
            'bg-custom-50 text-custom-400 ring-custom-600/10',
        ]);
        return '<span
            style="' . $cssVariables . '"
            class="' . $classes . '">' . strtolower($this->name) . '</span>';
    }
}
