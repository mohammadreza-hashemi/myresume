<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function activation($token){

$activationcode=\App\ActivationCode::whereCode($token)->first();
if(! $activationcode){
  dd('not exist');
  return redirect('/');
}
if($activationcode->expire < \Carbon\Carbon::now()){
  dd('expire');
  return redirect('/');
}
if($activationcode->used ==true){
  dd('used');
  return redirect('/');
}
$activationcode->user()->update([
  'active'=>1,
]);
$activationcode->update([
  'used'=>true,
]);
auth()->loginUsingId($activationcode->user->id);
return redirect('/');

    }
}
