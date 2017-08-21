@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Contact</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('phonebooks.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<div class="upload-instruction">
	<h4>
	Please convert your contact vcf file to csv file from this <a href="http://www.unc.edu/vtoc/">http://www.unc.edu/vtoc </a> site. After found csv file you can upload csv file. So your all valuable contacts will save life time.
	</h4>
	</div>
	
    {!! Form::open(array('route' => 'contactupload.store','method'=>'POST','files' => true)) !!}
         @include('phonebooks.formupload')
    {!! Form::close() !!}
@endsection