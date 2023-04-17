<?php

namespace App\Lib\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSkill extends Model
{
    use HasFactory;

    protected $table = '';

    protected $fillable = [
        'employee_id',
        'skill_level_id',
        'skill_name',
        'years_experience',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(SkillLevel::class, 'skill_level_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
