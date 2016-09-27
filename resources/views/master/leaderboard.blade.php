<?php
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
elseif(Auth::guard('teacher')->check()):
    $result = Auth::guard('teacher')->user();
elseif(Auth::guard('student')->check()):
    $result = Auth::guard('student')->user();
else:
    $result['name'] = "Guest";
endif;
$i=1;
?>
@extends('layouts.layout')
    @section('body')
    @endsection
    @section('content')
    <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                            <h1> Leaderboard </h1>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3" id="leaderboard">

                            <div class="box">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Points</th>
                                                    <th>Time</th>
                                                    <th>Rank</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $rank)
                                                <tr>
                                                    <td> <a>{{$rank->name}} </a> </td>
                                                    <td>{{$rank->score}}</td>
                                                    <td>{{$rank->time}}</td>
                                                    <td>{{$i++}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- /.row  -->
            </div>
                <!-- /.leaderboard container -->
            @endsection
