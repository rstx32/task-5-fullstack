<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;
use Validator;

class ArticleController extends Controller
{
    // display all article with pagination
    public function index()
    {
        return Article::paginate();
    }

    // display single article
    public function show($id)
    {
        $article = Article::find($id);

        if ($article == null) {
            return response()->json("Data Not Found!", 404);
        } else {
            return response()->json([new ArticleResource($article)]);
        }
    }

    // create new article
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "content" => "required|string",
            "image" => "required|URL",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $article = Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "image" => $request->image,
            "user_id" => $request->user_id,
            "category_id" => $request->category_id,
        ]);

        return response()->json([
            "success creating new article",
            new ArticleResource($article),
        ]);
    }

    // edit an article
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "content" => "required|string",
            "image" => "required|URL",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json([
            "article updated",
            new ArticleResource($article),
        ]);
    }

    // delete an article
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json("article deleted");
    }
}
