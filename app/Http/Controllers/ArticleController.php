<?php

namespace App\Http\Controllers;

use App\Article;
use Redis;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function single(Article $article){
      $article->increment('viewCount');
      // Redis::incr("views.{$article->id}.articles");
        $comment = $article->comments()->where('approved' ,1)->where('parent_id' , 0)->latest()->with(['comments' =>function($query){
          $query->where('approved',1)->latest();
        }])->get();
      return view('Home.article',['article' =>$article,'comment' =>$comment]);
    }
}
