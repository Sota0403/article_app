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

    private $article;
    private $user;
    private $tag;

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

    public function store()
    {
        $articleContent = session()->all();
        $attributes['title'] = $articleContent['title'];
        $attributes['tags'] = $articleContent['tags'];
        $attributes['content'] = $articleContent['content'];

        $article = $this->article->fill($attributes);
        $article->user_id = Auth::id();

        $article->save();
        $article->tags()->attach($articleContent['tags']); //ここの処理について聞いてみる

        session()->pull('title', '');
        session()->pull('tags', '');
        session()->pull('content', '');
        session()->pull('article_id', '');

        return redirect()->route('article.index');
    }

    public function edit($article_id)
    {
        $targetArticle = $this->article->find($article_id);
        $tags = $this->tag->all();
        $hasTagsArray = $targetArticle->tags->pluck('id')->toArray();
        return view('article.edit', compact('targetArticle', 'tags', 'hasTagsArray'));
    }

    public function update($article_id)
    {
        $articleContent = session()->all();
        $attributes['title'] = $articleContent['title'];
        $attributes['tags'] = $articleContent['tags'];
        $attributes['content'] = $articleContent['content'];

        $targetArticle = $this->article->find($article_id)->fill($attributes);
        $targetArticle->user_id = Auth::id();

        //既存のtag_idを一度削除して、新しく値を入れてくれる
        $targetArticle->tags()->sync($articleContent['tags']);

        $targetArticle->save();

        return redirect()->route('article.index');
    }

    public function show($article_id)
    {
        $article = $this->article->find($article_id);
        return view('article.show', compact('article'));
    }

    public function confirm(Request $request, $article_id = null)
    {
        $request->session()->put('title', $request->input('title'));
        $request->session()->put('content', $request->input('content'));
        $tagIdArray = array_map('intval', $request->input('tags'));
        $request->session()->put('tags', $tagIdArray);
        // dd($request->input('tags'));
        $request->session()->put('article_id', $article_id);

        $tags = DB::table('tags')->select('id', 'name')
                         ->get();

        // $hasTagsArray = $targetArticle->tags->pluck('id')->toArray();

        $articleContent = $request->session()->all();
        return view('article.confirm', compact('articleContent', 'tags'));
    }

    public function showMypage()
    {
        $currentUserId = Auth::id();
        $articles = DB::table('articles')
            ->select('articles.id', 'articles.title')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->join('article_tag', 'articles.id', '=', 'article_tag.article_id')
            ->join('tags', 'article_tag.tag_id', '=', 'tags.id')
            ->where('users.id', $currentUserId)
            ->paginate(self::PER_PAGE);

        return view('article.mypage', compact('articles'));
    }

    public function delete($article_id)
    {
        $this->article->find($article_id)->delete();
        return redirect()->route('article.index');
    }

    // public function showMypage()
    // {
    //     $user_id = Auth::id();
    //     $user = $this->user->where($user_id);
    //     return view('article.mypage', compact('user'));
    // }
}
