@extends('Admin.master')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>مدیران </h2>
          <div class="btn btn-group ">
            <a href="{{route('levels.create')}}" class="btn btn-sm btn-info"> ثبت مقام کاربر</a>
          </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>مقام</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                      @if(count($role->users))

                        @foreach($role->users as $user)
                          <td><a>{{ $user->name }}</a></td>
                          <td><a>{{ $user->email }}</a></td>
                          <td><a>{{ $role->lavel }}</a></td>
                          <td>
                            <form action="{{ route('levels.destroy'  , ['id' => $user->id]) }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="btn-group btn-group-xs">
                                    <a href="{{ route('levels.edit' , ['id' => $user->id]) }}"  class="btn btn-primary">ویرایش</a>
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </div>
                            </form>
                          </td>
                        @endforeach

                      @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align:center">
          {!! $roles->render() !!}
        </div>
    </div>
@endsection
