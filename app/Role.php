<?php

namespace App;

use App\User;
use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable=[
    'name','label',
  ];
    public function users(){
      return $this->belongsToMany(User::class);
    }

    public function permissions(){
      return $this->belongsToMany(Permission::class);
    }
    public function hasPermission($permission){
      if(is_string($permission)){
        return $this->permissions->contains('name',$permission);
      }
    }
}
