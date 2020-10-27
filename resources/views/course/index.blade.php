@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success mt-2" role="alert">
                    {{Session::get('success')}}
                    <a href="/admin/course" class="close">&times;</a>
                </div>
                <br>
            @endif
            <h5>دوره ها </h5>
            <hr>
            <a href="/admin/course/create" class="btn btn-success btn-lg"><i class="fa fa-plus">  دوره جدید</i></a>
            <table class="table mt-4">
                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>نمایش</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                    <th>ویدیو ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->title}}</td>
                        <td><a href="/admin/course/{{$course->id}}/display" class="btn btn-primary"><i class="fa fa-certificate"></i>نمایش</a></td>
                        <td><a href="/admin/course/{{$course->id}}/edit" class="btn btn-warning"><i class="fa fa-wrench"></i>ویرایش</a></td>
                        <td>
                            <form action="/admin/course/{{$course->id}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash ml-1"></i>حذف</button>
                            </form>
                        </td>
                        <td><a href="/admin/course/{{$course->id}}/video" class="btn btn-success"><i class="fa fa-eye"></i>ویدیو ها</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
