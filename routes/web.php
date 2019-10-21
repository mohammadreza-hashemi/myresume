<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('courses' ,'CourseController@filter');
//telegram BOT
Route::get('telegram','TelegramController@telegram');
Route::post('790750288:AAGdfspbEcWYN944cDZvA-D4RdnJzHEiCPo/webhook','TelegramController@telegram');



Route::get('/','HomeController@index');

//Search Routes
Route::get('search','HomeController@search');



Route::get('article/{articleSlug}','ArticleController@single');
Route::get('course/{courseSlug}','CourseController@single');
Route::post('comment','HomeController@comment');
Route::get('/user/active/email/{token}','userController@activation')->name('activation.account');



Route::get('sitemap','SiteMapController@index');
Route::get('sitemap-articles','SiteMapController@articles');

Route::get('feed/article','FeedController@articles');

Route::group(['middleware'=>'auth:web'],function(){
  Route::post('course/payment','CourseController@payment');//buy etesal be dargah va post etelaat
  Route::get('course/payment/check','CourseController@check');//callback//bargasht etelaat az dargah bastegi be dargah ya post ya get
});

Route::post('ajax',function(){
  $validator=\Validator::make(request()->all(),[//   \Validator::make(request()->all())   is bestssssssssttttttt
      'name' =>'required',
      'pic'  =>'required'
    ]);

    if ($validator->fails()){//or count($validator->errors()) or isset($validator->errors()) or strlen($validator->errors())
      return $validator->errors()->all();
    }

  $file=request()->file('pic');


    $year = Carbon\Carbon::now()->year;
    $imagePath = "/upload/images-Ajaxy/{$year}/";

    $filename = $file->getClientOriginalName();


    $file = $file->move(public_path($imagePath) , $filename);


    return $imagePath . $filename;
  });
Route::prefix('admin')->middleware(['auth:web','checkAdmin:web'])->namespace('Admin')->group(function(){
  Route::get('panel','PanelController@index');
  Route::post('/panel/upload-image','PanelController@ckeditorUploadimage');
  Route::resource('articles' , 'ArticleController');
  Route::resource('courses' , 'CourseController');
  Route::resource('comments','CommentController');
  Route::get('comment/unsuccessful' ,'CommentController@unsuccessful');
  Route::resource('episodes' , 'EpisodeController');
  Route::resource('roles','RoleController')->middleware('can:developer');
  Route::resource('permissions','PermissionController');
  Route::group([],function(){
    Route::get('users','UserController@index');
    Route::resource('levels','LevelManageController',['parameters' => ['levels' =>'user']]);
    Route::delete('/{user}/destroy','UserController@destroy')->name('users.destroy');
  });
});
// Auth::routes();
Route::group(['namespace' => 'Auth'] , function (){

  //Login and register  with google and github Socialite
    Route::get('login/google', 'LoginController@redirectToProviderGoogle');//loginRoute
    Route::get('login/google/callback', 'LoginController@handleProviderCallbackGoogle');//callbackRoute  Recive from google
    Route::get('login/github', 'LoginController@redirectToProviderGithub');//loginRoute
    Route::get('login/github/callback', 'LoginController@handleProviderCallbackGithub');//callbackRoute  Recive from google



    // Authentication Routes...
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('login', 'LoginController@showLoginForm')->name('login');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});
