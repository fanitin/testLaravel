<?php

namespace App\Http\Resources\Result;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kwota' => $this->kwota,
            'years' => $this->years,
            'procent' => $this->procent,
            'wynik' => $this->wynik,
            'phone' => $this->phone,
            'category_name' => $this->category->name

        ];
    }
}
