<?php
use App\Student;
use App\Teacher;
use App\ProgramRecord;

if(Session::get('type')=='student')
{
    $result = Student::find(Session::get('start'));
}
elseif (Session::get('type')=='teacher') {
    $result = Teacher::find(Session::get('start'));
    $programList = ProgramRecord::where('uploaded_by',$result->name)->get();
}

?>