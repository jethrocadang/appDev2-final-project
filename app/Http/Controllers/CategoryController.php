<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(
            Category::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {  
        $data = Category::whereHas('tasks', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($category->id);

        if(!$data){
            return $this->error('', 'You are not authorize to access this request!', 403);
        }

        return new CategoryResource($data) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();

        $category->update($request->all());

        $category->tasks()->attach($request->task_id);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
    }
}
