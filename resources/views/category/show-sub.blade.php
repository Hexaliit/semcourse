@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        <h3 class="pr-5 my-3 d-block">{{$orgCategory->name}}</h3>
        <br>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <ul>
                    @foreach($subCategories as $category)
                        <li class="p-3"><a href="/learn/{{$orgCategory->name}}/{{$category->name}}" class="text-info w-100 py-3 px-5"><i class="fa fa-check text-primary ml-3"></i>{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop



