@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="d-block my-4">{{$video->title}}</h4>
                <video width="100%" height="60%" controls controlsList="nodownload">
                    <source src="{{$video->video}}" type="video/mp4">
                    <source src="{{$video->video}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
@stop
