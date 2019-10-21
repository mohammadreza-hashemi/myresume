<?php

namespace App;


use App\Episode;
use App\Comment;
use App\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use Sluggable;

protected $guarded=[];
protected $casts=[
  // 'images' =>'boolean'//error array to string convention
  'images' =>'array'//error array to string convention

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

    public function path()
    {
      $locale=app()->getLocale();
        return "/$locale/course/$this->slug";
    }
    public function setBodyAttribute($value)
     {
         $this->attributes['description'] = str_limit(preg_replace('/<[^>]*>/' , '' , $value) , 200);
         $this->attributes['body'] = $value;
     }
     public function episodes(){
       return $this->hasMany(Episode::class);
     }
     public function comments()
     {
         return $this->morphMany(Comment::class, 'commentable');
     }
     public function categories()
     {
       return $this->belongsToMany(Category::class);
     }
     public function scopeFilter($query)
     {

       $category = request('category');
         if( isset($category) && trim($category) != '' && $category != 'all') {
             $query->whereHas('categories' , function ($query) use ($category) {
                 $query->whereId($category);
             });
         }

         //isser vojod dashtan === request()->has('type')
      $type=request('type');
      if(isset($type) &&trim($type) != ''){
        if(in_array($type,['free' ,'cash' ,'vip'])){
          $query->whereType($type); 
        }
      }

         if(request('order') == '1'){
           $query->oldest();
         }else{
           $query->latest();
         }

       return $query;
     }

}
