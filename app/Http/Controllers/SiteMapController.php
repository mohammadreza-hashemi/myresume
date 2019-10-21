<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SiteMapController extends Controller
{
    public function index()
    {                       //service provider
      $sitemap=app()->make('sitemap');
      $sitemap->add(url()->to('sitemap-articles'),'2019','0.9','daily');
      return $sitemap->render();
    }
    public function articles()
    {


      $sitemap=app()->make('sitemap');

      $articles=Article::latest()->get();
      foreach ($articles as $article) {
        // code...
      }
      $sitemap->add(url()->to($article->path()),$article->created_at,'0.9','Weekly');
      return $sitemap->render();
    }
}
