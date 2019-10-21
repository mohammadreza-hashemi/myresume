<?php

namespace App;

use App\Article;
use App\Course;
use App\Role;
use App\Comment;
use App\Payment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','level','active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function article(){
      return $this->hasMany(Article::class);
    }
    public function course(){
      return $this->hasMany(Course::class);
    }
    public function roles(){
      return $this->belongsToMany(Role::class);
    }
    public function hasRole($role){
      if(is_string($role))
      {
        return $this->roles->contains('name',$role);
      }

      // foreach ($role as $r) {
      //   if($this->hasRole($r->name)){
      //     return true;
      //   }
      // }
      // return false;
return !! $role->intersect($this->roles)->count();

    }
    public function isAdmin()
    {
      return $this->level == 'admin' ? true: false;
    }
    public function activationcode(){
      return $this->hasMany(\App\ActivationCode::class);
    }

    public function comment(){
      return $this->hasMany(Comment::class);
    }
    public function payments(){
      return $this->hasMany(Pyment::class);
    }
}
