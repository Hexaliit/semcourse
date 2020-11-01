@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="p-5 border">
                    <h5 class="d-block">ثبت نام</h5>
                    <hr>
                    <form action="/register" method="POST" class="mb-2">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                        @error('name')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}">
                        </div>
                        @error('email')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="password">رمز عبور</label>
                            <input type="password" class="form-control" name="password" value="{{old('password')}}">
                        </div>
                        @error('password')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="password_confirmation">تائید رمز عبور</label>
                            <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>
                        @error('password')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <button type="submit" class="btn btn-success px-4">ثبت نام</button>
                    </form>
                    <a href="/login" class="text-info ">عضو هستید؟ ورود</a>
                </div>
            </div>
        </div>
    </div>

@stop
