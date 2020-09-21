<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;

class LikeController extends Controller
{

    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

}
