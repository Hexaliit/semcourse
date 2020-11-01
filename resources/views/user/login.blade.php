@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                @if (Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{Session::get('success')}}
                        <a href="/login" class="close">&times;</a>
                    </div>
                    <br>
                @endif
                <div class="p-5 border">
                    <h5 class="d-block">ورود</h5>
                    <hr>
                    <form action="/login" method="POST" class="mb-2">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">رمز عبور</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        @if (Session::has('warning'))
                            <div class="alert alert-danger mt-2" role="alert">
                                {{Session::get('warning')}}
                            </div>
                        @endif
                        <button type="submit" class="btn btn-success px-4">ورود</button>
                    </form>
                    <a href="/register" class="text-info ">عضو نستید؟ ثبت نام</a>
                </div>
            </div>
        </div>
    </div>

@stop
