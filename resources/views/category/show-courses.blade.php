@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        <h3 class="py-3 mr-3"><a href="/learn/{{$parent->name}}">{{$parent->name}}</a>   \   {{$category->name}}</h3>
        @if (count($courses) < 1)
            <h5 class="py-3 text-muted">دوره ای وجود ندارد</h5>
        @endif
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <img class="card-img-top card-image" src="{{($course->avatar && $course->avatar !=null ) ? $course->avatar : 'http://localhost:8000/image/main.jpg'}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->title}}</h5>
                            <p class="card-text">{{Illuminate\Support\Str::limit($course->content,150)}}</p>
                            <a href="/course/{{str_replace(' ','-',$course->title)}}" class="btn btn-primary">ادامه مطلب</a>
                            <span class="d-block mt-3 text-muted">{{\Morilog\Jalali\Jalalian::forge(explode(' ',$course->created_at)[0])->format('%B %d، %Y')}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
