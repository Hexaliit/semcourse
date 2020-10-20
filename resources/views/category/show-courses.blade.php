@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="py-3 mr-3"><a href="/learn/{{$parent->name}}">{{$parent->name}}</a>   \   {{$category->name}}</h3>
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <img class="card-img-top" src="{{--{{$course->avatar}}--}}http://localhost:8000/image/main.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->title}}</h5>
                            <p class="card-text">{{Illuminate\Support\Str::limit($course->content,150)}}</p>
                            <a href="#" class="btn btn-primary">ادامه مطلب</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
