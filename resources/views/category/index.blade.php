@extends('layouts.app')

@section('content')
    @include('inc.admin-header')
    <div class="container">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success mt-2" role="alert" id="alert-block">
                    {{Session::get('success')}}
                    <a class="btn p-0 close" id="close-btn">&times;</a>
                </div>
                <br>
            @endif
            <h5>دسته بندی </h5>
            <hr>
            <a href="/admin/category/create" class="btn btn-success btn-lg"><i class="fa fa-plus">  دسته بندی جدید</i></a>
            <table class="table mt-4">
                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cats as $cat)
                        <tr>
                            <td>{{$cat->name}}</td>
                            <td><a href="/admin/category/{{$cat->id}}/edit" class="btn btn-primary"><i class="fa fa-wrench"></i>ویرایش</a></td>
                            <td>
                                <form action="/admin/category/{{$cat->id}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash ml-1"></i>حذف</button>
                                </form>
                            </td>
                        </tr>
                        @foreach($subs as $sub)
                            @if ($sub->parent_id == $cat->id)
                                <tr>
                                    <td class="pr-4"><i class="fa fa-arrow-left"></i> {{$sub->name}}</td>
                                    <td><a href="/admin/category/{{$sub->id}}/edit" class="btn btn-primary"><i class="fa fa-wrench"></i>ویرایش</a></td>
                                    <td>
                                        <form action="/admin/category/{{$sub->id}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash ml-1"></i>حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
