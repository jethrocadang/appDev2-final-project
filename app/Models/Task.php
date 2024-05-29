<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    public function categories(): BelongsToMany 
    {
        return $this->belongsToMany(Category::class, 'categories_tasks');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
