@extends('layouts.app')

@section('content')
    @include('inc.header')
    @if (Session::has('success'))
        <div class="alert alert-success mt-2" role="alert" id="alert-block">
            {{Session::get('success')}}
            <a class="btn p-0 close" id="close-btn">&times;</a>
        </div>
        <br>
    @endif
    <div id="myCarousel" class="carousel slide h-100" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner h-100">
            <div class="carousel-item active">
                <img
                    src="{{($banners[0]->avatar !=null) ? $banners[0]->avatar : 'http://localhost:8000/image/main.jpg'}}"
                    class="bd-placeholder-img w-100 main-slider">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1 class="text-dark">{{$banners[0]->title}}</h1>
                        <p class="text-dark">{{Illuminate\Support\Str::limit($banners[0]->content,50)}}</p>
                        <p><a class="btn btn-lg btn-dark" href="/course/{{str_replace(' ','-',$banners[0]->title)}}"
                              role="button">نمایش دوره</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img
                    src="{{($banners[1]->avatar !=null) ? $banners[1]->avatar : 'http://localhost:8000/image/main.jpg'}}"
                    class="bd-placeholder-img w-100 main-slider">
                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-dark">{{$banners[1]->title}}</h1>
                        <p class="text-dark">{{Illuminate\Support\Str::limit($banners[1]->content,50)}}</p>
                        <p><a class="btn btn-lg btn-dark" href="/course/{{str_replace(' ','-',$banners[1]->title)}}"
                              role="button">نمایش دوره</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img
                    src="{{($banners[2]->avatar !=null) ? $banners[2]->avatar : 'http://localhost:8000/image/main.jpg'}}"
                    class="bd-placeholder-img w-100 main-slider">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1 class="text-dark">{{$banners[2]->title}}</h1>
                        <p class="text-dark">{{Illuminate\Support\Str::limit($banners[2]->content,50)}}</p>
                        <p><a class="btn btn-lg btn-dark" href="/course/{{str_replace(' ','-',$banners[2]->title)}}"
                              role="button">نمایش دوره</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="newest my-5">
        <h5 class="p-3">جدید ترین دوره ها</h5>
        <div class="row">
            @foreach($newest as $new)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top card-image"
                             src="{{$new->avatar}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$new->title}}</h5>
                            <p class="card-text">{{Illuminate\Support\Str::limit($new->content,150)}}</p>
                            <a href="/course/{{str_replace(' ','-',$new->title)}}" class="btn btn-primary">ادامه
                                مطلب</a>
                            <span
                                class="d-block mt-3 text-muted">{{\Morilog\Jalali\Jalalian::forge(explode(' ',$new->created_at)[0])->format('%B %d، %Y')}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="newest my-5">
        <h5 class="p-3">جدید ترین دوره های رایگان</h5>
        <div class="row">
            @foreach($frees as $free)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top card-image"
                             src="{{$free->avatar}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$free->title}}</h5>
                            <p class="card-text">{{Illuminate\Support\Str::limit($free->content,150)}}</p>
                            <a href="/course/{{str_replace(' ','-',$free->title)}}" class="btn btn-primary">ادامه
                                مطلب</a>
                            <span
                                class="d-block mt-3 text-muted">{{\Morilog\Jalali\Jalalian::forge(explode(' ',$free->created_at)[0])->format('%B %d، %Y')}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
