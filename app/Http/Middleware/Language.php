<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // dd(config('app.locales'));
      $locale=$request->segment(1);
      if(!array_key_exists($locale,config('app.locales')))
      {
        $segments=$request->segments();//همsegments   داریم هم segment()//که segmentsارایه هست و تمام segment ها رو بر میردونه

        $segments[0]=config('app.fallback_locale');//اضافه کردن faبه تمام روت ها//  harchi fallvack basehe e tamam route ha ono oo bar migardone
        return redirect(implode('/',$segments));

      }
        app()->setLocale($locale);
        return $next($request);
    }
}
