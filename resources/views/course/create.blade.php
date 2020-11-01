@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class="d-block">دوره جدید</h3>
                <form action="/admin/course" method="POST" class="mb-3" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="1">
                    <div class="form-group">
                        <label for="title">عنوان دوره</label>
                        <input type="text" class="form-control w-50" name="title" value="{{old('title')}}">
                    </div>
                    @error('title')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="content">توضیحات دوره</label>
                        <textarea name="content" class="form-control" cols="30" rows="10">{{old('content')}}</textarea>
                    </div>
                    @error('content')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="price">قیمت دروه (تومان)</label>
                        <input type="number" class="form-control w-50" name="price" value="{{old('price')}}">
                    </div>
                    @error('price')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="avatar">تصویر دوره</label>
                        <input type="file" class="form-control w-50" name="avatar">
                    </div>
                    @error('avatar')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="source">منبع دوره</label>
                        <input type="file" class="form-control w-50" name="source">
                    </div>
                    @error('source')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror

                    <div class="form-group">
                        <label for="category">دسته بندی</label>
                        <select class="form-control w-50" name="category[]" multiple>
                            @foreach($main as $cat)
                                <optgroup label="{{$cat->name}}">
                                    @foreach($categories as $category)
                                        @if ($category->parent_id == $cat->id)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <button type="submit" class="btn btn-success w-25">ذخیره</button>
                    <a href="/admin/category" class="btn btn-danger w-25">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
@stop
