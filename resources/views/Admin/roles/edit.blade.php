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
            <h2>ایجاد مقاله</h2>
        </div>
        <form class="form-horizontal" action="{{ route('roles.update' ,['id' => $roles->id ]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include ('Admin.section.error')

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">عنوان مقام </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="عنوان را وارد کنید" value="{{$roles->name or old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="label" class="control-label">توضیحات </label>
                    <textarea rows="4" class="form-control" name="label" id="label" placeholder="توضیحات را وارد کنید">{{$roles->label}}</textarea>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for=""class="control-label">Permission</label>
                <select class="form-control" name="permission_id[]" multiple>
                  @foreach(\App\Permission::get() as $permission)
                    <option value="{{$permission->id}}" {{ in_array(trim($permission->id),$roles->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{$permission->name}}-{{$permission->label}}</option>
                  @endforeach
                </select>
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
