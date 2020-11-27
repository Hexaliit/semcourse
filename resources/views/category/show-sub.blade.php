@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
            <h5 class="d-block py-4">{{$orgCategory->name}}</h5>
                <ul>
                    @foreach($subCategories as $category)
                        <li>
                            <a href="/category/{{$orgCategory->name}}/{{$category->name}}" class="text-info  d-block py-4"><i class="fa fa-check text-primary ml-3"></i>{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop



