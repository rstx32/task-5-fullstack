<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Validator;

class CategoryController extends Controller
{
    // display all category
    public function index()
    {
        return Category::all();
    }

    // display single category
    public function show($id)
    {
        $category = Category::find($id);

        if ($category == null) {
            return response()->json("Data Not Found!", 404);
        } else {
            return response()->json([new CategoryResource($category)]);
        }
    }

    // create new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "user_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $category = Category::create([
            "name" => $request->name,
            "user_id" => $request->user_id,
        ]);

        return response()->json([
            "success creating new category",
            new CategoryResource($category),
        ]);
    }

    // edit a category
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "user_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $category->name = $request->name;
        $category->user_id = $request->user_id;
        $category->save();

        return response()->json([
            "category updated",
            new CategoryResource($category),
        ]);
    }

    // delete a category
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json("category deleted");
    }
}
