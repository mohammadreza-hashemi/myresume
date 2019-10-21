<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class ActivationCode extends Model
{
    protected $guarded = [];

public function scopeCreateCode($query,$user)
  {
    $code =$this->code();
  return $query->create([
    'user_id'=>$user->id,
    'code'=>$code,
    'expire'=>\Carbon\Carbon::now()->addminutes(15),
    ]);
  }
  protected function code(){
    do{
      $code=Str::random(60);
      $check_code_indatabase=static::whereCode($code)->get();
    }while( ! $check_code_indatabase->isEmpty());
    return $code;
  }
  public function user(){
    return $this->belongsto(\App\User::class);
  }
}
