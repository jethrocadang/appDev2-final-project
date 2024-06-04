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
                'dueDate' => $this->due_date,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'categories' => $this->categories->map(function ($category) {
                    return [
                        'id' => (string) $category->id,
                        'attributes' => [
                            'name' => $category->name,
                            'createdAt' => $category->created_at,
                            'updatedAt' => $category->updated_at,
                        ]
                    ];
                })
            ]

        ];
    }
}
