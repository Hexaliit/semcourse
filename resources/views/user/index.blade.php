@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success mt-2" role="alert" id="alert-block">
                    {{Session::get('success')}}
                    <a class="btn p-0 close" id="close-btn">&times;</a>
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
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->email}}</td>
                        <td>{{$user->level}}</td>
                        <td>{{$user->balance}}</td>
                        <td><a href="/admin/user/{{$user->id}}/edit" class="btn btn-primary">ویرایش</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
