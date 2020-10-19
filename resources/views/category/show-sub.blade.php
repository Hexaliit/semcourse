@extends('layouts.app')

@section('content')
    <h3 class="pr-5 my-3">{{$orgCategory->name}}</h3>
    <br>
    <div class="clearfix"></div>
    <div class="col-md-8">
        <ul>
            @foreach($subCategories as $category)
                <li class="p-3"><a href="/learn/{{$orgCategory->name}}/{{$category->name}}" class="text-info w-100 py-3 px-5">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
@stop



