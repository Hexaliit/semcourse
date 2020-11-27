@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        @if (!empty($courses) && count($courses) > 0)
            <h3 class="my-3 text-info">{{count($courses)}}  نتیجه برای "{{$searchTerm}}"</h3>
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-4 my-3">
                        <div class="card">
                            <img class="card-image"
                                 src="{{$course->avatar}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$course->title}}</h5>
                                <p class="card-text">{{Illuminate\Support\Str::limit($course->content,150)}}</p>
                                <a href="/course/{{str_replace(' ','-',$course->title)}}" class="btn btn-primary">ادامه
                                    مطلب</a>
                                <span
                                    class="d-block mt-3 text-muted">{{\Morilog\Jalali\Jalalian::forge(explode(' ',$course->created_at)[0])->format('%B %d، %Y')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <h3 class="my-3 text-info">هیچ نتیجه ای برای "{{$searchTerm}}" یافت نشد </h3>
        @endif
    </div>
@stop
