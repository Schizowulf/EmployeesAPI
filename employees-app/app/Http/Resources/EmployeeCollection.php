<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
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
