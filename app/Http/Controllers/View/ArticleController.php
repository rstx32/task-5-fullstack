<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use File;

class ArticleController extends Controller
{
    // show all article
    public function index()
    {
        $articles = Article::where('user_id', Auth::user()->id)->get();
        return view('article.index', ['articles' => $articles]);
    }

    // show add article form
    public function create()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('article.form-create', ['categories' => $categories]);
    }

    // add article
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "content" => "required|string",
            "image" => "required|mimes:jpg,jpeg,png",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $imageName = $request->image->hashName();
        $request->image->move(public_path('images'), $imageName);

        Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "image" => $imageName,
            "user_id" => Auth::user()->id,
            "category_id" => $request->category_id,
        ]);

        return redirect('/articles');
    }

    // show an article
    public function show($id)
    {
        $article = Article::find($id);
        return view('article.detail', ['article' => $article]);
    }

    // edit an article
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('article.form-edit', ['article' => $article, 'categories' => $categories]);
    }

    // update an article
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "content" => "required|string",
            "image" => "mimes:jpg,jpeg,png",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        // if image inserted, then replace current image with new image
        if($request->image!=null){
            $currentImage = Article::find($id)->image;
            if(File::exists(public_path('images/' . $currentImage))){
                File::delete(public_path('images/' . $currentImage));
            }

            $imageName = $request->image->hashName();
            $request->image->move(public_path('images'), $imageName);

            Article::find($id)->update([
                "title" => $request->title,
                "content" => $request->content,
                "image" => $imageName,
                "category_id" => $request->category_id,
            ]);
        } else {
            Article::find($id)->update([
                "title" => $request->title,
                "content" => $request->content,
                "category_id" => $request->category_id,
            ]);
        }

        return redirect('/articles/ ' . $id);
    }

    // delete an article
    public function destroy($id)
    {
        $imageName = Article::find($id)->image;
        if(File::exists(public_path('images/' . $imageName))){
            File::delete(public_path('images/' . $imageName));
        }
        Article::destroy($id);
        return redirect('/articles');
    }
}
