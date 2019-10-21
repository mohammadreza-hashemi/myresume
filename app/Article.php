<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;
use App\Category;

class Article extends Model
{
    use Sluggable;

protected $guarded=[];
//با کست میتونب نوع داده ها تو مشخص کنی
protected $casts=[
  // 'images' =>'boolean'//error array to string convention
  'images' =>'array',//error array to string convention
  'body' =>'array'
];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
      $locale=app()->getLocale();

        return "/$locale/article/$this->slug";
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }
    public function scopeSearch($query,$keywords)
    {
$keyword1=explode(' ',$keywords);
foreach($keyword1 as $keyword){

  $query->whereHas('categories',function ($query) use ($keyword){
    $query->where('slug' ,'LIKE',"%".$keyword."%");
  })  ->orWhere('title' ,'LIKE',"%".$keyword."%")
      ->orWhere('tags' ,'LIKE' ,"%".$keyword."%");

}



      // $query->whereHas('categories',function ($query) use ($keywords){
      //   $query->where('slug' ,'LIKE',"%".$keywords."%");
      // })  ->orWhere('title' ,'LIKE',"%".$keywords."%")
      //     ->orWhere('tags' ,'LIKE' ,"%".$keywords."%");
      // // $query->where('title' ,'LIKE',"%".$keywords."%")
      // //       ->orWhere('tags' ,'LIKE' ,"%".$keywords."%");

    return $query;
    }


}
