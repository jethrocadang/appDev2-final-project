<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories
        $categories = Category::factory()->count(10)->create();

        // Create users and associate them with tasks, while also associating categories with tasks
        User::factory()->count(5)->create()->each(function ($user) use ($categories) {
            // Create tasks for each user
            $tasks = Task::factory()->count(3)->create(['user_id' => $user->id]);

            // Associate categories with tasks
            foreach ($tasks as $task) {
                $task->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
            }
        });

    }
}
