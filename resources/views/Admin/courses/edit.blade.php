@extends('Admin.master')
@section('script')
<script src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('body',{
    filebrowserUploadUrl : '/admin/panel/upload-image',
    filebrowserImageUploadUrl : '/admin/panel/upload-image'
  })
</script>
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>ویرایش دوره  </h2>
        </div>
        <form class="form-horizontal" action="{{ route('courses.update' , ['id' =>$courses->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{method_field('PATCH')}}
            @include ('Admin.section.error')

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="title" class="control-label">عنوان دوره</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{ $courses->title }}">
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="title" class="control-label">نوع دوره </label>
                <select id="type" name="type" class="form-control">
                  <option value="vip"  {{$courses->type =='vip'    ? 'selected' : ''}}>اعضای ویزه</option>
                  <option value="free" {{$courses->type =='free'  ? 'selected' : '' }}>رایگان </option>
                  <option value="cash" {{$courses->type =='cash' ? 'selected' : ''}}>پولی</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                  <label for="body" class="control-label">متن</label>
                  <textarea rows="5" class="form-control" name="body" id="body" placeholder="متن مقاله را وارد کنید" ></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                  <label for="images" class="control-label">تصویر دوره </label>
                  <input type="file" class="form-control" name="images" id="images" placeholder="تصویر دوره را وارد کنید " >
              </div>
              <div class="col-sm-12">
                    <div class="row">
                        @foreach( $courses->images['images'] as $key => $image)
                            <div class="col-sm-2">
                                <label class="control-label">
                                    {{ $key }}
                                    <input type="radio" name="imagesThumb" value="{{ $image }}" {{ $courses->images['thumb'] == $image ? 'checked' : '' }} />
                                    <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-6">
                <label for="tags" class="control-label">قیمت </label>
                <input type="text" class="form-control" name="price" id="price" placeholder="قیمت را وارد کنید" value="{{ $courses->price }}">
              </div>
                <div class="col-sm-6">
                    <label for="tags" class="control-label">تگ ها</label>
                    <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ ها را وارد کنید" value="{{$courses->tags }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger">ویرایش </button>
                </div>
            </div>
        </form>
    </div>
@endsection
