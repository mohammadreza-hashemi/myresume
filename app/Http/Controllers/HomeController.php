<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Course;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SEOMeta;
use App\Jobs\SendMail;

class HomeController extends Controller
{
    public function index()
    {

 // return $article=Article::findOrFail(22)->categories()->attach([1,2]);




    //   $job= new SendMail(User::find(1),'sadcscs');
    //   $job->delay(Carbon::now()->addSeconds(10))->onQueue('send:mails');
    //   $this->dispatch($job);
    // return 'done';

      // app()->setLocale('en');
$local=app()->getLocale();


                    //or redis or file or ...
      // cache()->store('file')->put('name','value',Carbon::now()->addMinute(10));
      // return cache()->store('file')->get('name');

//برای استفاده از کش ردیس فقط envرو بزار روی ردیس و بعد مراحل عادی کش رو برو همین ...

// cache()->increment('vv',5);
// cache()->flush();//delete all cache
// cache()->forever();//تا زمانی که سرور هست اینم هست و هیچوقت حزف نمیشه
// return cache('vv');

//seo::generate رو در ویویی بزار که اون کنترولر اجراش میکنه
SEOMeta::setTitle(__('messages.title'));//__helper function
SEOMeta::setDescription('myDescription');

    cache()->pull('articles');
    cache()->pull('courses');

    cache()->flush();

    if(cache()->has('articles')){
      $article=cache('articles');
    }else{
      $article=Article::whereLang($local)->latest()->take(8)->paginate(5);
      cache(['articles'=>$article] , Carbon::now()->addMinutes(1));
      // cache()->put('articles',$article,Carbon::now()->addMinute(1))//or
    }

    if(cache()->has('courses')){
      $courses=cache('courses');
    }else{
      $courses=Course::latest()->take(4)->paginate(5);
      cache(['courses'=>$courses] , Carbon::now()->addMinutes(1));
    }


        return view('Home.index',['articles'=>$article,'courses'=>$courses]);
    }
    public function comment(){
    // return  $jDate =\Morilog\Jalali\Jalalian::forge('today')->format('%A, %d %B %y');
      $this->validate(request(),[
        'comment' =>'required|min:5',
      ]);



      // Comment::create(array_merge(['user_id' =>auth()->user()->id ], request()->all()));//or
      auth()->user()->comment()->create(request()->all());
      return back();

    }


    public function search()
    {
      $keyword=request()->input('search');
      $articles=Article::search($keyword)->orderBy('id','desc')->get();
      return $articles;
    }

}
