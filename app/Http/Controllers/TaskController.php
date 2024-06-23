<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(
            Task::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();

        $task = Task::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        $task->categories()->attach($request->category_id);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return $this->error('', 'You are not authorize to access this request!', 403);
        }

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request->validated();

        $task->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);
    

        $task->categories()->sync($request->category_id);
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return $this->error('', 'You are not authorize to access this request!', 403);
        } else {
            $task->delete();
        }

        return response(null, 204);
    }
}
