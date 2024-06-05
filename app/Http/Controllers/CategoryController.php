<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Exception;

class CategoryController extends Controller
{

    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(
            // Category::all()
            Category::whereHas('tasks', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get()
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
        $category = Category::whereHas('tasks', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($category->id);

        return new CategoryResource($category);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();
        $category->update($request->all());
        
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response(null, 204);
    }
}
