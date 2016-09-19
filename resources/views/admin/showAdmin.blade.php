<?php
$result = Auth::guard('admin')->user();
?>
@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ Session::get('class') }}">{{ Session::get('message') }}</div>
    @endsection
@section('content')
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Show Admin</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p>Name</p>
                        </div>
                        <div class="col-md-4">
                            <p>Email</p>
                        </div>
                        <div class="col-md-3">
                            <p>Edit Details</p>
                        </div>
                    </div>
                    @foreach($user as $users)
                        <div class="row">
                            <div class="col-md-3">
                                <p>{{$users->name}}</p>
                            </div>
                            <div class="col-md-4">
                                <p>{{$users->email}}</p>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary"><a style="color:white;"href="{{url('/admin/admin/'.$users->id)}}" >Edit</a></button>
                            </div>
                        </div><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
