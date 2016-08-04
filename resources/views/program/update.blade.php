<?php
use App\program_details;


    $result=Program_Details::where('record_id',Session::get('record_id'))->get();
    // $result=json_decode($result);
?>

@extends('layouts.app')

@section('content')
<h2>Click on the links to edit the program</h2>
<?php 
foreach ($result as $key) {
	$link=url('/update')."/".$key->id;
	?>
	<a href="{{ $link }}">{{ $key->program_name }}</a><br>
	<?php
	
}


?> 


@endsection