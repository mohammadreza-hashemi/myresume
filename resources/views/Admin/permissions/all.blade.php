@extends('Admin.master')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>Permissions</h2>
          <div class="btn btn-group ">
            <a href="{{route('permissions.create') }}" class="btn btn-sm btn-info">ایجاد permission</a>
          </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام مقام</th>
                    <th>توضیحات</th>

                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td><a>{{ $permission->name }}</a></td>
                        <td><a>{{ $permission->label }}</a></td>
                        <td>
                          <form action="{{ route('permissions.destroy'  , ['id' => $permission->id]) }}" method="post">
                              {{ method_field('delete') }}
                              {{ csrf_field() }}
                              <div class="btn-group btn-group-xs">
                                  <a href="{{ route('permissions.edit' , ['id' => $permission->id]) }}"  class="btn btn-primary">ویرایش</a>
                                  <button type="submit" class="btn btn-danger">حذف</button>
                              </div>
                          </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align:center">
          {!! $permissions->render() !!}
        </div>
    </div>
@endsection
