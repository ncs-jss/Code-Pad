<?php
use App\student;
use App\teacher;
use App\programRecord;

if(Session::get('type')=='student')
{
    $result=student::find(Session::get('start'));
}
elseif (Session::get('type')=='teacher') {
    $result=teacher::find(Session::get('start'));
    $programList=programRecord::where('uploaded_by',$result->name)->get();
}

?>