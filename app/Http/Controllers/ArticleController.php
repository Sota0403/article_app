<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\User;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class ArticleController extends Controller
{

    const PER_PAGE = 10;

    private $article;
    private $user;
    private $tag;
    private $like;

    public function __construct(Article $article, User $user, Tag $tag, Like $like)
    {
        $this->article = $article;
        $this->user = $user;
        $this->tag = $tag;
        $this->like = $like;
    }

    public function index()
    {

        $articles = DB::table('articles')
            ->join('users','articles.user_id', '=', 'users.id')
            ->select([
              'users.id as user_id',
              'users.name as user_name',
              'articles.id',
              'articles.title',
              'articles.content',
            ])
            ->orderByDesc('articles.id')
            ->paginate(10);

            //ここで、もう一つクエリを発行して、articles.idに紐付いたtagのidとnameを配列に格納する
            foreach ($articles as $article) {
              $tags = DB::table('tags')
                            ->join('article_tag', 'tags.id', '=', 'article_tag.tag_id')
                            ->select('tags.id', 'tags.name')
                            ->where('article_tag.article_id', $article->id)
                            ->get();

              $article->tags = $tags;
            }

            $articleHistoryIds[] = Cookie::get('article1');
            $articleHistoryIds[] = Cookie::get('article2');
            $articleHistoryIds[] = Cookie::get('article3');
            $articleHistoryIds[] = Cookie::get('article4');

            $articleHistories = $this->article->whereIn('id', $articleHistoryIds)
                                              ->get();

        $currentUser = DB::table('users')->where('id', Auth::id())
                                         ->first();

        return view('article.index', compact('articles', 'currentUser', 'articleHistories'));
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
        $article->tags()->attach($articleContent['tags']);

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

        if(
          $article_id != Cookie::get('article1') &&
          $article_id != Cookie::get('article2') &&
          $article_id != Cookie::get('article3') &&
          $article_id != Cookie::get('article4')
        ) {
          $articleHistory1 = Cookie::queue('article1', $article_id);
          $articleHistory2 = Cookie::queue('article2', Cookie::get('article1'));
          $articleHistory3 = Cookie::queue('article3', Cookie::get('article2'));
          $articleHistory4 = Cookie::queue('article4', Cookie::get('article3'));
        }

        $likeExist = $this->like->where('article_id', $article->id)
                          ->where('user_id', Auth::id())
                          ->exists();

        return view('article.show', compact('article', 'likeExist'));
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

    public function addLike($article_id) {
        $article = $this->article->find($article_id);

        $currentUserId = Auth::id();
        $article->likes()->insert(['user_id' => $currentUserId, 'article_id' => $article->id]);

        return redirect()->route('article.show', $article_id);
    }

    public function unlike($article_id) {

      $this->like->where('article_id', $article_id)
                 ->where('user_id', Auth::id())
                 ->delete();

      return redirect()->route('article.show', $article_id);
    }
}
