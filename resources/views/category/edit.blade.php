@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="d-block">ویرایش دسته بندی</h3>
                <form action="/admin/category/{{$cat->id}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for="name">نام دسته بندی</label>
                        <input type="text" class="form-control w-50" name="name" value="{{$cat->name}}">
                    </div>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $message)
                            <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="parent_id">زیر دسته بندی</label>
                        <select class="form-control w-50" name="parent_id">
                            <option value="0" {{ ( $cat->parent_id == null ) ? 'selected' : '' }}>دسته بندی اصلی</option>
                            @foreach($cats as $category)
                                <option value="{{$category->id}}" {{ ( $category->id === $cat->parent_id ) ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-25">ذخیره</button>
                    <a href="/admin/category" class="btn btn-danger w-25">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
@stop
