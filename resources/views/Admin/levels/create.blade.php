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
            <h2>ثبت مقام </h2>
        </div>
        <form class="form-horizontal" action="{{ route('levels.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('Admin.section.error')

            <div class="form-group">
              <div class="col-sm-12">
                <label for=""class="control-label">Usres</label>
                <select class="form-control" name="user_id" >
                  @foreach(\App\User::whereLevel('admin')->get() as $user)
                    <option value="{{$user->id}}">{{$user->email}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for=""class="control-label">Roles</label>
                <select class="form-control" name="role_id[]" multiple>
                  @foreach(\App\Role::get() as $role)
                    <option value="{{$role->id}}">{{$role->name}}-{{$role->label}}</option>
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
