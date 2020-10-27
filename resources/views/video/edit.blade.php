@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/video/{{$video->id}}" class="my-4" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="oldVideo" value="{{$video->video}}">
                    <div class="form group">
                        <label for="title">عنوان ویدیو</label>
                        <input type="text" class="form-control w-50" name="title" value="{{$video->title}}">
                    </div>
                    @error('title')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <div class="form group">
                        <label for="video">ویدیو</label>
                        <input type="file" class="form-control-file" name="video">
                    </div>
                    @error('video')
                    <span class="invalid-feedback my-3 d-block">{{$message}}</span>
                    @enderror
                    <button type="submit" class="btn btn-success w-25 mt-3">ذخیره</button>
                    <a href="/admin/course/{{$course->id}}/video" class="btn btn-danger w-25 mt-3">بازگشت</a>
                </form>
            </div>
        </div>
    </div>
@stop
