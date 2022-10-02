<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // show all article
    public function index()
    {
        $articles = Article::all();
        return view('article.public.index', ['articles' => $articles]);
    }

    // show an article
    public function show($id)
    {
        $article = Article::find($id);
        return view('article.public.detail', ['article' => $article]);
    }
}
