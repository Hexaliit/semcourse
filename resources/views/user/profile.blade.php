@extends('layouts.app')

@section('content')
    @include('inc.header')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                @if (Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{Session::get('success')}}
                    </div>
                    <br>
                @endif
                <div class="info my-2">
                    <span class="d-block py-2"><i class="fa fa-user text-success mx-2"></i>{{$user->name}}</span>
                    <span class="d-block py-2"><i class="fa fa-envelope text-primary mx-2"></i>{{$user->email}}</span>
                    <span class="d-block py-2"><i class="fa fa fa-money text-warning mx-2"></i>{{$user->balance}}</span>
                    <a href="/account/edit" class="text-primary col-md-4"><i class="fa fa-edit mx-2"></i>ویرایش اطلاعات</a>
                    <a href="/account/edit-password" class="text-danger col-md-4"><i class="fa fa-wrench mx-2"></i>تغییر رمز عبور</a>
                    <a href="#" class="text-success col-md-4"><i class="fa fa-briefcase mx-2"></i>افزایش موجودی</a>
                </div>
                <div class="courses">
                    <h5 class="d-block py-2 border-bottom">دوره های شما</h5>
                    @if (count($courses) > 0)
                        @foreach($courses as $course)
                            <span class="text-info d-block my-2">{{$course->title}}</span>
                        @endforeach
                        @else
                        <span class="text-warning d-block">شما هیچ دوره ای خریداری نکرده اید</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
