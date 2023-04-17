<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'skill_name' => $this->skill_name,
            'skill_level' => $this->level->name,
            'years_experience' => $this->years_experience,
        ];
    }
}
