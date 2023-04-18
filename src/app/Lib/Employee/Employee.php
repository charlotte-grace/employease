<?php

namespace App\Lib\Employee;

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
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->employee_uuid = strtoupper(Str::random(2)) . '-' . rand(1000, 9999);
        });
    }

    /**
     * @return HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(EmployeeSkill::class);
    }
}
