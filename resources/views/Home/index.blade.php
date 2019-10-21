@extends('Home.master')

@section('content')

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>{{__('messages.welcome.title')}}</h1>
        <p>{{__('messages.welcome.description')}}
        </p>
    </header>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h3>آخرین دوره ها</h3>
        </div>
    </div>
    <div class="row ">
      @foreach($articles as $article)
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="{{$article->images['thumb']}}" alt="images">
                <div class="caption">
                    <h3><a href="{{$article->path()}}">{{$article->title}}</a></h3>
                    <p>{{ str_limit($article->description , 50)}}</p>
                    <p>
                        <a href="#" class="btn btn-primary">خرید</a> <a href="#" class="btn btn-default">اطلاعات بیشتر</a>
                    </p>
                </div>
                <div class="ratings">
                    <p class="pull-left">{{$article->viewCount}}</p>
                    <!-- <p class="pull-right">{{Redis::get("views.{$article->id}.articles")}}</p> -->

                </div>
            </div>
        </div>
    </div>
@endforeach()
    <div style="text-align:center">
      {!! $articles->render() !!}
    </div>
    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12">
                <h3>مقالات</h3>
            </div>
            @foreach($courses as $course)
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="{{$course->images['thumb']}}" alt="">
                    <div class="caption">
                        <h4><a href="{{$course->path()}}">‌{{$course->title}}</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">{{$course->viewCount}}</p>
                        <!-- <p class="pull-right">{{Redis::get("views.{$article->id}.articles")}}</p> -->

                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
@endsection
