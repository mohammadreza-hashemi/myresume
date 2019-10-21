@extends('Home.master')

@section('content')

<form  action="courses" method="get">
 <div class="form-group col-md-3">
   <select class="form-control" name="type">
     <option value="all" {{request('type') == 'all' ?'selected' : '' }}>همه نوع ها </option>
     <option value="vip" {{request('type') == 'vip' ?'selected' : '' }}>اعضای ویژه </option>
     <option value="cash"{{request('type') == 'cash' ?'selected' : '' }}>پولی </option>
     <option value="free"{{request('type') == 'free' ?'selected' : '' }}>رایگان </option>
   </select>
 </div>
 <div class="form-group col-md-3">
   <select class="form-control" name="category">
 <option value="all">همه دسته ها</option>
   @foreach(\App\Category::all() as $category)

   <option value="{{$category->id}}" {{request('category') == $category ? 'selected' : ''}}>{{$category->name}}</option>
   @endforeach
</select>
</div>

 <div class="form-group col-md-3">
   <label for=""class="chebox-inline">
     <input type="checkbox" name="order" value="1" {{request('order') == '1' ? 'checked' : '' }}>از اول به اخر
   </label>
 </div>
 <div class="form-group col-md-3">
   <button type="submit" class="btn btn-danger">فیلتر</button>
 </div>
</form>



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
                        {{-- commmmetttttttttttttttttttt--}}
                        {{-- <p class="pull-right">{{Redis::get("views.{$article->id}.articles")}}</p> --}}

                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
    {!! $courses->appends(['type' =>request('type') ,'category' =>request('category') ,'order' =>request('order') ])->render() !!}
@endsection
