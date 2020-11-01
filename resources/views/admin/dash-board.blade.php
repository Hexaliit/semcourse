@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (Session::has('error'))
                    <div class="alert alert-danger mt-2" role="alert">
                        {{Session::get('error')}}
                        <a href="/admin" class="close">&times;</a>
                    </div>
                    <br>
                @endif
                <h5 class="d-block my-3"><strong class="text-info">{{$user->name}}</strong> عزیز خوش آمدید</h5>
                <span>سطح دسترسی شما : <span class="text-muted">{{$user->level}}</span></span>
            </div>
        </div>
    </div>
@stop
