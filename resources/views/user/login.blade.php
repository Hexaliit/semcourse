@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                @if (Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert" id="alert-block">
                        {{Session::get('success')}}
                        <a class="btn p-0 close" id="close-btn">&times;</a>
                    </div>
                    <br>
                @endif
                @if (Session::has('login'))
                    <div class="alert alert-warning mt-2" role="alert" id="alert-block">
                        {{Session::get('login')}}
                        <a class="btn p-0 close" id="close-btn">&times;</a>
                    </div>
                    <br>
                @endif
                @if (Session::has('warning'))
                    <div class="alert alert-danger mt-2" role="alert" id="alert-block">
                        {{Session::get('warning')}}
                        <a class="btn p-0 close" id="close-btn">&times;</a>
                    </div>
                @endif
                <div class="p-5 border">
                    <h5 class="d-block">ورود</h5>
                    <hr>
                    <form action="/login" method="POST" class="mb-2">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">رمز عبور</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success px-4">ورود</button>
                    </form>
                    <a href="/register" class="text-info ">عضو نیستید؟ ثبت نام</a>
                </div>
            </div>
        </div>
    </div>

@stop
