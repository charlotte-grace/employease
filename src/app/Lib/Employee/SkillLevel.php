<?php

namespace App\Lib\Employee;

use App\Lib\ValueObjects\ValueObject;

class SkillLevel extends ValueObject
{
    protected $table = 'skill_levels';

    public const SLUG_LEVEL_BEGINNER = 'beginner';
    public const SLUG_LEVEL_INTERMEDIATE = 'intermediate';
    public const SLUG_LEVEL_EXPERT = 'expert';

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
}
