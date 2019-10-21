@extends('Admin.master')
@section('script')
<script src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('description',{
    filebrowserUploadUrl : '/admin/panel/upload-image',
    filebrowserImageUploadUrl : '/admin/panel/upload-image'
  })
</script>
<script>
        $(document).ready(function () {
            $('#course_id').selectpicker();
        })
    </script>
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>ایجاد ویدیو </h2>
        </div>
        <form class="form-horizontal" action="{{ route('episodes.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('Admin.section.error')

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="title" class="control-label">عنوان ویدیو </label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group">
               <div class="col-sm-12">
                   <label for="course_id" class="control-label">دوره مرتبط</label>
                   <select class="form-control" name="course_id" id="course_id">
                       @foreach(\App\Course::orderby('id' ,'desc')->get() as $course)
                           <option value="{{ $course->id }}">{{ $course->title }}</option>
                       @endforeach
                   </select>
               </div>
           </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="title" class="control-label">نوع ویدیو </label>
                <select id="type" name="type" class="form-control">
                  <option value="vip">اعضای ویزه</option>
                  <option value="free" selected>رایگان </option>
                  <option value="cash">پولی</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                  <label for="description" class="control-label">متن</label>
                  <textarea rows="5" class="form-control" name="description" id="description" placeholder="متن مقاله را وارد کنید"></textarea>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                  <label for="tهپث" class="control-label">زمان </label>
                  <input type="text" class="form-control" name="time" id="time" placeholder="قیمت را وارد کنید" value="{{ old('time') }}">
                </div>
                <div class="col-sm-6">
                    <label for="number" class="control-label">تگ ها</label>
                    <input type="text" class="form-control" name="number" id="number" placeholder="شماره را وارد کنید " value="{{ old('number') }}">
                </div>
            </div>


            <div class="form-group">
              <div class="col-sm-6">
                <label for="tags" class="control-label">ادرس ویدیو</label>
                <input type="text" class="form-control" name="videoUrl" id="videoUrl" placeholder="ادرس ویدیو " value="{{ old('videoUrl') }}">
              </div>
                <div class="col-sm-6">
                    <label for="tags" class="control-label">تگ ها</label>
                    <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ ها را وارد کنید" value="{{ old('tags') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger">ارسال</button>
                </div>
            </div>
        </form>
    </div>
@endsection
