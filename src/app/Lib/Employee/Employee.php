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
        return $this->hasMany(EmployeeSkill::class, 'employee_id');
    }

    /**
     * @param Collection $skills
     * @return $this
     */
    public function setSkills(Collection $skills): self
    {
        // Delete the employees existing skills.
        $this->getSkills()->each(function (EmployeeSkill $skill) {
            $skill->delete();
        });

        // Create new skill records for the updated list of skills.
        $skills->each(function ($skill) {
            $this->skills()->save($skill);
        });

        return $this;
    }

    /**
     * @return Collection<EmployeeSkill>
     */
    public function getSkills(): Collection
    {
        return $this->skills ?? new Collection();
    }
}
