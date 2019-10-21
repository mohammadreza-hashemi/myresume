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
            <h2>ایجاد permission</h2>
        </div>
        <form class="form-horizontal" action="{{ route('permissions.store') }}" method="post" >
            {{ csrf_field() }}
            @include ('Admin.section.error')

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">عنوان مقام </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="label" class="control-label">توضیحات </label>
                    <textarea rows="4" class="form-control" name="label" id="label" placeholder="توضیحات را وارد کنید" value="{{ old('label') }}"></textarea>
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
