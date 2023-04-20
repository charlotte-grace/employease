<?php

namespace App\Lib\Employee;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    /**
     * @var string
     */
    protected $table = 'skill_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * @param string $slug
     * @return Model|SkillLevel|Builder
     */
    public static function getBySlug(string $slug): Model|SkillLevel|Builder
    {
        return static::query()
            ->where('slug', $slug)
            ->first() ?? new self();
    }

    /**
     * @param string $name
     * @return Model|SkillLevel|Builder
     */
    public static function getByName(string $name): Model|SkillLevel|Builder
    {
        return static::query()
            ->where('name', $name)
            ->first() ?? new self();
    }
}
