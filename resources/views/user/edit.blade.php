@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10  mt-5">
                <div class="p-2 border">
                    <h5 class="py-2">ویرایش کاربر</h5>
                    <form action="/admin/user/{{$user->id}}" method="POST">
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
                            <input type="text" name="email" class="form-control" value="{{$user->email}}">
                        </div>
                        @error('email')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="balance">موجودی</label>
                            <input type="number" name="balance" class="form-control" value="{{$user->balance}}">
                        </div>
                        @error('balance')
                        <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="level">سطح دسترسی</label>
                            <select class="form-control w-50" name="level">
                                <option value="کاربر" {{($user->level == 'کاربر') ? 'selected' : ''}}>کاربر</option>
                                <option value="استاد" {{($user->level == 'استاد') ? 'selected' : ''}}>استاد</option>
                                <option value="مدیر" {{($user->level == 'مدیر') ? 'selected' : ''}}>مدیر</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success px-4">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
