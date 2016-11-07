<?php
$result = Auth::guard('admin')->user();
// var_dump($user);
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
                @if($user->type != 'student')
                    <div class="panel-heading">Show Admin</div>
                    <div class="panel-body">
                        <div class="row table-responsive">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit Details</th>
                                    <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $users)
                                  <tr>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->email}}</td>
                                    <td><a style="color:white;"href="{{url('/admin/Admin/'.$users->id)}}" ><button class="btn btn-primary">Edit</button></a></td>
                                    <td><a style="color:white;"href="{{url('/admin/Admin/'.$users->id)}}" ><button class="btn btn-danger">Delete</button></a></td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="panel-heading">Show Students</div>
                    <div class="panel-body">
                        <div class="row table-responsive">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Admission No.</th>
                                    <th>Edit Details</th>
                                    <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $users)
                                  <tr>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->admision_no}}</td>
                                    <td><a style="color:white;"href="{{url('/admin/Student/'.$users->id)}}" ><button class="btn btn-primary">Edit</button></a></td>
                                    <td><a style="color:white;"href="{{url('/admin/Student/'.$users->id)}}" ><button class="btn btn-danger">Delete</button></a></td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
