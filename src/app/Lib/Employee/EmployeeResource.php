<?php

namespace App\Lib\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'employee_uuid' => $this->employee_uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'email_address' => $this->email_address,
            'date_of_birth' => $this->date_of_birth,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'skills' => EmployeeSkillResource::collection($this->skills),
        ];
    }
}
