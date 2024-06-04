<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'category',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'updatedAt' => $this->updated_at,
                'createdAt' => $this->created_at

            ],
            'relationships' => [

                'tasks' => $this->tasks->map(function ($task) {
                    return [
                        'type' => 'task',
                        'id' => (string) $task->id,
                        'attributes' => [
                            'title' => $task->name,
                            'description' => $task->description,
                            'dueDate' => $task->due_date,
                            'updatedAt' => $task->updated_at,
                            'createdAt' => $task->created_at
                        ]
                    ];
                })
            ]

        ];
    }
}
