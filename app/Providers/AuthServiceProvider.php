<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // \App\User::class=>\App\policies\userPolic::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
// Gate::define('show_comment',function ($user){
//   return $user->hasRole(Permission::whereName('show_comment')->first()->roles);
// });



//برای هر permission یه گیت میسازه
foreach ($this->getPermissions() as $permission) {
  Gate::define($permission->name,function ($user) use ($permission){
    return $user->hasRole($permission->roles);
  });
}


    }
    protected function getPermissions(){
      return Permission::with('roles')->get();
    }
}
