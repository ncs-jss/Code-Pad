<?php
$result = Auth::guard('admin')->user();
?>
@extends('layouts.layout')

@section('content')
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Show User</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p>Name</p>
                        </div>
                        <div class="col-md-4">
                            <p>Email</p>
                        </div>
                        <div class="col-md-2">
                            <p>Projects</p>
                        </div>
                        <div class="col-md-3">
                            <p>Assign Projects</p>
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
                            <div class="col-md-2">
                                <p>{{$users->projects}}</p>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary"><a href="{{url('/admin/user/'.$users->id)}}" >Assign Projects</a></button>
                            </div>
                        </div><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
