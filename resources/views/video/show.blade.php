@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        @if (Session::has('warning'))
            <div class="alert alert-danger mt-2" role="alert">
                {{Session::get('warning')}}
                <a href="" class="close">&times;</a>
            </div>
            <br>
        @endif
        <div class="row">
            <div class="col-md-12 my-3 d-block"><a href="/course/{{str_replace(' ','-',$course->title)}}" class="text-info">{{$course->title}}</a> \ <span>{{$video->title}}</span></div>
            <div class="col-md-8">
                <h4 class="d-block my-4">{{$video->title}}</h4>
                <video width="100%" height="60%" controls controlsList="nodownload">
                    <source src="{{$video->video}}" type="video/mp4">
                    <source src="{{$video->video}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <div class="mt-5">
                    <a href="/download/{{str_replace('/','-',$video->video)}}" class="text-center text-info d-block"><i class="fa fa-cloud-download mx-2"></i>دریافت ویدیو</a>
                </div>
            </div>
            <div class="col-md-4 my-5 pt-4">
                <div class="px-1 border">
                    <h5 class="text-secondary text-center py-3 border-bottom m-0">محتوی دوره</h5>
                    @foreach ($videos as $item)
                        <a href="/course/{{str_replace(' ','-',$course->title)}}/{{str_replace(' ','-',$item->title)}}" class="text-info border-bottom p-3 d-block"><i class="fa fa-play-circle pl-3"></i>{{$item->title}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
