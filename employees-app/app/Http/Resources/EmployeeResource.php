<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            "name"          => $this->name,
            "patronymic"    => $this->patronymic,
            "surname"       => $this->surname,
            "birthday"      => date("d.m.Y", strtotime($this->birthday)),
            "position"      => $this->position,
            "phone"         => $this->phone,
            'avatar_url'    => $this->avatar_url
        ];
    }
}
