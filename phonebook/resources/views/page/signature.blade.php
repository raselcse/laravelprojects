@extends('layouts.app')
 
@section('content')
    <h2> About us </h2>
	<style>
	
	</style>
		<div class="wrapper" style="position:relative;">
		  <div width=400 height=200 style="background-color:#dcdcdc; width:400px; height:200px;">
		  </div>
		  <canvas id="signature-pad" class="signature-pad" width=400 height=200 style="position: absolute;left: 0;top:0;width:400px; height:200px">
			  
		   </canvas>
		</div>
		<div>
		  <button data-url="{{ url('signatureupload') }}" id="save">Save</button>
		  <button id="clear">Clear</button>
		</div>
@endsection



