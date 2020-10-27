@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="course-avatar mt-5">
                    @if ($course->avatar !=null)
                        <img src="{{$course->avatar}}" alt="" class="w-100">
                        @else
                        <span class="text-danger py-2">
                            عکسی برای این دوره وجود ندارد
                        </span>
                    @endif
                </div>
                <div class="course-title border-bottom py-2">
                    عنوان دوره :
                    <h3 class="p-3">{{$course->title}}</h3>
                </div>
                <div class="course-content border-bottom py-2">
                    محتوی دوره :
                    <p class="p-3">{{$course->content}}</p>
                </div>
                <div class="course-source border-bottom py-2">
                    منبع دوره :
                    @if ($course->source !=null)
                        <span class="text-success py-2">
                            وجود دارد
                        </span>
                    @else
                        <span class="text-danger py-2">
                            منبعی برای این دوره وجود ندارد
                        </span>
                    @endif
                </div>
                <div class="course-price border-bottom py-2">
                    قیمت دوره :
                    <span class="p-3">{{$course->price}}</span>
                </div>
                <div class="course-price py-2">
                    ویدئو های این دوره :
                    @if (count($videos) > 0)
                        <div class="pt-2">
                            @foreach($videos as $video)
                                <span class="d-block py-2 border-top text-secondary">{{$video->title}}</span>
                            @endforeach
                        </div>
                        @else
                        <span class="py-2 d-block text-danger">
                            ویدئوی برای این دوره موجود نمی باشد
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </div>

@stop
