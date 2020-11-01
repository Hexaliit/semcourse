@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success mt-2" role="alert">
                    {{Session::get('success')}}
                    <a href="/admin/user" class="close">&times;</a>
                </div>
                <br>
            @endif
            <h5>کاربران </h5>
            <table class="table my-4">
                <thead>
                <tr>
                    <th>ایمیل</th>
                    <th>سطح</th>
                    <th>موجودی</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->email}}</td>
                        <td>{{$user->level}}</td>
                        <td>{{$user->balance}}</td>
                        <td><a href="/admin/user/{{$user->id}}/edit" class="btn btn-primary">ویرایش</a></td>
                        <td>
                            <form action="/admin/user/{{$user->id}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash ml-1"></i>حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
