<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        return view('article.index');
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(ArticleRequest $request)
    {
        $attributes = $request->all();
        $this->article->fill($attributes);
        $attributes['user_id'] = Auth::id();

        $this->article->save();
    }

    public function edit()
    {
        return view('article.edit');
    }

    public function update()
    {
        //
    }

    public function show()
    {
        return view('article.show');
    }

    public function delete()
    {
        //
    }
}
