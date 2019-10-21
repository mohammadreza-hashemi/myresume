<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
      $user =User::latest()->paginate(5);
      return view('Admin.users.all',['users'=>$user]);
    }


    public function destroy(User $user){
      $user->delete();
      return back();
    }
}
