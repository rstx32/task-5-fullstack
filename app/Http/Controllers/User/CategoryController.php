<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller
{
    // show all category
    public function index()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();

        return view('category.index', ['categories' => $categories]);
    }

    // show add category form
    public function create()
    {
        return view('category.form-create');
    }

    // add category
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if($validator->fails()){
            return redirect('/user/categories/create')->with(['errors' => $validator->errors()]);
        }

        Category::create([
            "name" => $request->name,
            "user_id" => Auth::user()->id,
        ]);

        return redirect('/user/categories')->with(['success' => 'success creating category']);
    }

    // show list articles of category
    public function show($id)
    {
        $articles = Article::where('user_id', Auth::user()->id)
        ->where('category_id', $id)
        ->get();

        $category = Category::find($id);

        return view('category.detail', ['articles' => $articles, 'category' => $category]);
    }

    // edit a category
    public function edit($id)
    {
        $categories = Category::where('user_id', Auth::user()->id)->find($id);
        return view('category.form-edit', ['categories' => $categories]);
    }

    // update a category
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if($validator->fails()){
            return redirect('/user/categories/ ' . $id . '/edit')->with(['errors' => $validator->errors()]);
        }

        Category::find($id)->update([
            "name" => $request->name,
        ]);

        return redirect('/user/categories')->with(['success' => 'success updating category']);
    }

    // delete a category and it's article
    public function destroy($id){
        $categories = Category::findOrFail($id);
        $categories->article->each->delete();
        $categories->delete();

        return redirect('/user/categories')->with(['success' => 'success deleting category']);
    }
}
