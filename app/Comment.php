<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{

  protected $guarded=[];

  /**
 * Get the owning commentable model.
 */
public function commentable()
{
    return $this->morphTo();
}
public function user(){
  return $this->belongsTo(User::class);
}
public function comments(){          //foreign_key local_key
  return $this->hasMany(Comment::class,'parent_id' ,'id');
  // return $this->hasMany(Comment::class,'parent_id' ,'id')->where('approved',1)->latest();
}
public function setCommentAttribute($value)
{
  $this->attributes['comment']=str_replace(PHP_EOL,"<br>",$value);
}
}
