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
        // $articles = DB::table('articles')
        //                      ->select([
        //                        'users.id',
        //                        'users.name as user_name',
        //                        'articles.id',
        //                        'articles.title',
        //                        'articles.content',
        //                        'tags.id',
        //                        'tags.name'
        //                      ])
        //                     //  ->select(DB::raw('users.id, users.name as user_name, articles.id, articles.title, articles.content, articles.content, count(tags.id), count(tags.name)'))
        //                      ->join('users','articles.user_id', '=', 'users.id')
        //                      ->join('article_tag','articles.id', '=', 'article_tag.article_id')
        //                      ->join('tags','article_tag.tag_id', '=', 'tags.id')
        //                     //  ->groupBy('tags.id', 'tags.name')->get();
        //                      ->orderBy('articles.id','desc')
        //                      ->paginate(self::PER_PAGE);

        $articles = $this->article->orderBy('id', 'desc')
                                  ->paginate(15);

        $currentUser = DB::table('users')->where('id', Auth::id())
                                         ->first();

        return view('article.index', compact('articles', 'currentUser'));
    }

    public function create()
    {
        $tags = $this->tag->all();
        return view('article.create', compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
        $attributes = $request->all();
        $tags = $request->input('tags');
        // dd($tags);
        $article = $this->article->fill($attributes);
        $article->user_id = Auth::id();

        $article->save();
        $article->tags()->attach($tags);
        // dd($article);
        return redirect()->route('article.index');
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
