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
            "image" => "required|mimes:jpg,jpeg,png",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $imageName = $request->image->hashName();
        $request->image->move(public_path('images'), $imageName);

        $article = Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "image" => $imageName,
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
            "image" => "mimes:jpg,jpeg,png",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // if image inserted, then replace current image with new image
        if($request->image!=null){
            $currentImage = Article::find($id)->image;
            if(File::exists(public_path('images/' . $currentImage))){
                File::delete(public_path('images/' . $currentImage));
            }

            $imageName = $request->image->hashName();
            $request->image->move(public_path('images'), $imageName);

            $article->title = $request->title;
            $article->content = $request->content;
            $article->image = $imageName;
            $article->user_id = $request->user_id;
            $article->category_id = $request->category_id;
            $article->save();
        } else {
            $article->title = $request->title;
            $article->content = $request->content;
            $article->user_id = $request->user_id;
            $article->category_id = $request->category_id;
            $article->save();
        }

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
