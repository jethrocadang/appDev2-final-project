<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'due_date' => $this->due_date,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'categories' => $this->categories->map(function ($category) {
                    return [
                        'id' => (string) $category->id,
                        'attributes' => [
                            'name' => $category->name,
                            'created_at' => $category->created_at,
                            'updated_at' => $category->updated_at,
                        ]
                    ];
                })
            ]

        ];
    }
}
