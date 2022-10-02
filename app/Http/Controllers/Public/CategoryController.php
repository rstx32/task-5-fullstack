<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    // show all Category
    public function index()
    {
        $categories = Category::all();
        return view('category.public.index', ['categories' => $categories]);
    }

    // show an Category
    public function show($id)
    {
        $articles = Article::where('category_id', $id)->get();
        $category = Category::find($id);

        return view('category.public.detail', ['articles' => $articles, 'category' => $category]);
    }
}
