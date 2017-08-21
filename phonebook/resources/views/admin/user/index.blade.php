@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Contacts List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contactupload') }}"> Upload Contact list</a>
                <a class="btn btn-success" href="{{ route('phonebooks.create') }}"> Create New Contacts</a>
				 
				@if (Auth::user()->type =='admin')
					<a  class="btn btn-success" href="{{ route('admin.user.index') }}">All User list</a>
					<a  class="btn btn-success" href="{{ route('adminphonebooks.index') }}">All Phonebook list</a>
				@endif
				
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	
	    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-md-6">
			<form action="/contactSearch" role="search" class="form-inline pull-right srcTop">
                <h2><span>search Contacts </span> <input type="text" name="searchString" id="searchString" value=""> </h2>
				<input type="hidden" id="token" value="{{ csrf_token() }}">
			</form> 	
            </div>
			<div class="col-md-6 text-center">
              
				
            </div>
            
        </div>
    </div>
	
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($users as $i=>$user)
    <tr>
        <td>{{++$i}}</td>
        <td>{{ $user->name}}</td>
        <td>{{ $user->email}}</td>
        <td>{{ $user->type}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('admin.user.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('admin.user.edit',$user->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['admin.user.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
@endsection