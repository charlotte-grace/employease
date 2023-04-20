<?php

namespace App\Lib\Employee;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'employees';

    /**
     * @var string[]
     */
    protected $fillable = [
        'employee_uuid',
        'first_name',
        'last_name',
        'contact_number',
        'email_address',
        'date_of_birth',
        'street_address',
        'city',
        'postal_code',
        'country',
    ];
    /**
     * @var mixed|string
     */
    private mixed $employee_uuid;

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (self $employee) {
            $employee->employee_uuid = strtoupper(Str::random(2)) . rand(1000, 9999);
        });

        static::creating(function (self $employee) {
            $employee->employee_uuid = strtoupper(Str::random(2)) . rand(1000, 9999);
        });
    }

    /**
     * @return HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(EmployeeSkill::class);
    }

    /**
     * Set the skills of the employee to the provided collection.
     *
     * @param array $skills The array of skills to set.
     * @return $this
     */
    public function setSkills(array $skills): self
    {
        $skillNames = collect($skills)->pluck('skill_name')->toArray();
        $skillsToDelete = $this->getSkills()->whereNotIn('skill_name', $skillNames);
        $skillsToUpsert = $skills;

        $skillsToDelete->each(fn (EmployeeSkill $skill) => $skill->delete());
        $this->skills()->upsert($skillsToUpsert, ['employee_id', 'skill_name']);

        return $this;
    }

    /**
     * Get the employee's skills.
     *
     * @return Collection<EmployeeSkill>
     */
    public function getSkills(): Collection
    {
        return $this->skills ?? new Collection();
    }
}
