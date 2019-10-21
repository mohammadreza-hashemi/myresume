<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      \Schema::defaultStringLength(191);

//recaptcha |required
      \Validator::extend('recaptcha',function($attribute,$value,$parrameters,$validator){
//post to google
        $client =new Client();
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => config('services.recaptcha.secret'),
            'response' =>$value,
            'remoteip'=>request()->ip(),
              ]
        ]);

        $response=json_decode($response->getBody());
        return $response->success;

      });



//view composer //share data
view()->composer('Admin.section.header',function($view){
  $commentunsuccessfulcount=\App\Comment::where('approved',0)->count();
  $view->with(['commentunsuccessfulcount'=>$commentunsuccessfulcount]);
});

view()->composer('Admin.section.header',function($view){
  $commentsuccessfulcount=\App\Comment::where('approved',1)->count();
  $view->with(['commentsuccessfulcount'=>$commentsuccessfulcount]);
});

    }
}
