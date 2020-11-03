@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="p-5 border">
                    <h5 class="d-block">تغییر رمز عبور</h5>
                    <hr>
                    @if (Session::has('warning'))
                        <div class="alert alert-danger mt-2" role="alert" id="alert-block">
                            {{Session::get('warning')}}
                            <a class="btn p-0 close" id="close-btn">&times;</a>
                        </div>
                        <br>
                    @endif
                    <form action="/account" method="POST" class="mb-2">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label for="oldPass">رمز قبلی</label>
                            <input type="password" class="form-control" name="oldPass">
                        </div>
                        @error('oldPass')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="password">رمز جدید</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="password_confirmation">تائید رمز جدید</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-success px-4">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
