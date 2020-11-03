@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10  mt-5">
                <div class="p-2 border">
                    <h5 class="py-2">ویرایش کاربر</h5>
                    <form action="/account/edit" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        </div>
                        @error('name')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" disabled>
                        </div>
                        @error('email')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <button type="submit" class="btn btn-success px-4">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
