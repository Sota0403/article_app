<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    const PER_PAGE = 10;


    public function __construct(Article $article, User $user, Tag $tag)
    {
        $this->article = $article;
        $this->user = $user;
        $this->tag = $tag;
    }

    public function index()
    {
        // $articles = $this->article->all();
        $articles = DB::table('articles')->join('users','articles.user_id', '=', 'users.id')
                             ->select('users.id', 'users.name', 'articles.title', 'articles.content')
                             ->paginate(self::PER_PAGE);

        $currentUser = DB::table('users')->where('id', Auth::id())
                                         ->first();

        return view('article.index', compact('articles', 'currentUser'));
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

    public function show($article_id)
    {
        $article = $this->article->find($article_id);
        return view('article.show', compact('article'));
    }

    public function delete()
    {
        //
    }

    public function showMypage()
    {
        $user_id = Auth::id();
        $user = $this->user->where($user_id);
        return view('article.view', compact('user'));
    }
}
