@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="banner position-relative w-100">
                <div class="course-banner w-100">
                    <img src="{{$course->avatar}}" alt="" class="w-100 h-100">
                    <div class="course-intro-shadow w-100 h-100 position-absolute"></div>
                    <div class="course-title w-100 h-100 position-absolute text-white">
                        <h1 class="text-center">
                            {{$course->title}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="border p-2 my-3">
                    <h4 class="d-block text-info my-4">درباره دوره</h4>
                    <p class="pt-3">{{$course->content}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="py-3 border mt-3 mb-5">
                    <h5 class="pb-2 d-block pr-2 border-bottom">برچسب ها :</h5>
                    @foreach($categories as $cat)
                        <span class="bg-info text-white mx-2 p-2 rounded">{{$cat->name}}</span>
                    @endforeach
                </div>
                <div class="py-3 border my-3">
                    <h5 class="pb-2 d-block pr-2 text-center border-bottom">منتشر شده توسط</h5>
                    <h5 class="d-block py-2 text-primary text-center">{{$name}}</h5>
                </div>
                <div class="py-3 border my-3">
                    <h5 class="pb-2 d-block pr-2 text-center border-bottom">درسنامه</h5>
                    @if ($course->source != null)
                        <a href="/download/{{str_replace('/','-',$course->source)}}" class="d-block py-2 text-primary text-center"><i class="fa fa-cloud-download mx-2"></i>دریافت</a>
                        @else
                        <span class="text-danger d-block py-2 text-center">منبعی برای این دوره موجود نیست</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h3 class="my-4">
                    سرفصل های دوره {{$course->title}}
                </h3>
            </div>
        </div>
        <div class="col-md-8 border my-4 p-0">
            <h5 class="border-bottom text-dark m-0 p-3">
                فیلم های آموزشی
            </h5>
            @foreach ($videos as $video)
                <a href="/course/{{str_replace(' ','-',$course->title)}}/{{str_replace(' ','-',$video->title)}}" class="text-info border-bottom p-3 d-block"><i class="fa fa-play-circle pl-3"></i>{{$video->title}}</a>
            @endforeach
        </div>
    </div>

@stop
