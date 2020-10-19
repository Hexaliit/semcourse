@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($mainCategories as $category)
            <a href="/learn/{{$category->name}}" class="text-info py-4 border col-md-6">{{$category->name}}</a>
        @endforeach
    </div>
@stop
