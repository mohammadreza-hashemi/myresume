<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelManageController extends Controller
{
    public function index(){
      $role=Role::latest()->with('users')->paginate(20);
      return view('Admin.levels.all',['roles' =>$role]);
    }
    public function create(){
      return view('Admin.levels.create');
    }


    public function store(Request $request){
      $this->validate($request,[
        'user_id' =>'required',
        'role_id' =>'required',
      ]);

User::find(request()->input('user_id'))->roles()->sync(request()->input('role_id'));
      return redirect(route('levels.index'));
    }

                    /////use parameters 'level'=>'user'
    public function edit(User $user){
      return view('Admin.levels.edit',['user' =>$user]);
    }
    public function update(Request $request,User $user){
      $user->roles->sync($request->input('role_id'));
      return redirect(route('levels.index'));


    }
    public function destroy(User $user)
    {
      $user->roles()->detach();
      return redirect(route('levels.index'));
    }
}
