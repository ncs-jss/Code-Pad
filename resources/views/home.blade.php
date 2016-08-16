<?php
use App\programRecord;
use App\teacher;
if(Session::get('type')=='teacher'):
    $result=teacher::find(Session::get('start'));
    $programList=programRecord::where('uploaded_by',$result->name)->get();
endif
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    <?php
                    if(Session::get('type')=='teacher'):
                        foreach($programList as $flight)
                            echo '<a href=update/'.$flight->code.'>'.$flight->name.'</a><br>';
                    endif
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
