<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;


    protected $fillable = ['title','description', 'completed', 'due_date'];

    // Many to Many with categories
    public function categories(): BelongsToMany 
    {
        return $this->belongsToMany(Category::class, 'categories_tasks');
    }

    //One to Many with users
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
