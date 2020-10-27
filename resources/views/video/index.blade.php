@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success mt-2" role="alert">
                    {{Session::get('success')}}
                    <a href="/admin/video" class="close">&times;</a>
                </div>
                <br>
            @endif
            <h5>نمایش ویديو ها برای دوره {{$course->title}}</h5>
            <hr>
            <a href="/admin/course/{{$course->id}}/video/create" class="btn btn-success btn-lg"><i class="fa fa-plus">  ویدیو جدید</i></a>
            @if (count($videos) > 0)
                    <table class="table mt-4">
                        <thead>
                        <tr>
                            <th>عنوان ویدیو</th>
                            <th>نمایش ویدئو</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <td>{{$video->title}}</td>
                                <td><a href="/admin/video/{{$video->id}}/display" class="btn btn-primary"><i class="fa fa-certificate"></i>نمایش</a></td>
                                <td><a href="/admin/course/{{$course->id}}/video/{{$video->id}}/edit" class="btn btn-warning"><i class="fa fa-wrench"></i>ویرایش</a></td>
                                <td>
                                    <form action="/admin/video/{{$video->id}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash ml-1"></i>حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                <div class="text danger">ویدیو ای برای این دوره وجود ندارد</div>
            @endif
        </div>
    </div>

@stop
