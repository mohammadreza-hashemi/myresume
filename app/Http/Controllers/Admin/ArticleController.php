<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\User;
use App\Permission;
use App\Role;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // dd(auth()->user()->hasRole('manager'));
      // dd(auth()->user()->hasRole(Permission::whereName('show_comment')->first()->roles));
    // dd(Role::whereName('manager')->first()->hasPermission('show_comment'));
        $article=Article::orderby('id','asc')->paginate(3);
        return view('Admin.articles.all',['articles' =>$article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $file=$request->file('images');
        if($file->isValid() && $request->isMethod('post') && request()->hasFile('images')){
auth()->loginUsingId(1);
          $imagesUrl = $this->uploadImages($file);
          auth()->user()->article()->create(array_merge($request->all() , [ 'images' => $imagesUrl]));
          alert()->success('مقالتو ثبت کردم ','STORED')->autoclose(2000)->persistent('باشه دمت گرم')->persistent('دهنت سرویس');

          return redirect(route('articles.index'));

        }
        return 'ERROR';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {

      alert()->warning('مراقب باشید چیزی را اشتباه اپدیت نکنید!', 'هشدار')->persistent('باشه')->autoclose(3000);

      return view('Admin.articles.edit',['article' => $article ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
    $file=$request->file('images');
    $inputs=$request->all();
    if($file)
      {
        $inputs['images'] = $this->uploadImages($file);

      }else{
        $inputs['images'] =$article->images;
      }
      $inputs['images']['thumb']=$inputs['imagesThumb'];
      unset($inputs['imagesThumb']);
      $article->update($inputs);
      alert()->success('مقاله شما اپدیت شد!','UPDATED');
      return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
alert()->error('مقالتو حذف کردم ','DELETED')->html()->persistent('OK');

        return redirect(route('articles.index'));
    }
}
