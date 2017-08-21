@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Contacts List</h2>
            </div>
            <div class="pull-right">

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
        <div class="col-lg-12 col-md-12 margin-tb">
            <div>
			
					<form name="search-form" id="search-form" action="http://localhost/phonebook/public/contactSearch" role="search" method="post" class="form-inline srcTop">
						<div class="col-md-12">
							<span class="search-title">search Contacts </span>
							@if (isset($user_search_string))
								<input type="text" name="searchString" id="searchString" value="{{$user_search_string}}"> 
							@else
							   <input type="text" name="searchString" id="searchString" value="">
							@endif	
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
							<label>Sorting by: </label> 
							@if(isset($order_by))
							<select name="order_by" id="sorting">
								<option value="id" <?php if($order_by==="id") echo "selected";?>>ID</option>
								<option value="name" <?php  if($order_by==="name") echo "selected";?>>Name</option>
								<option value="email" <?php if($order_by==="email") echo "selected";?>>Email</option>
								<option value="mobile" <?php if($order_by==="mobile") echo "selected";?>>Mobile</option>
							</select>
							@else
								<select name="order_by" id="sorting">
								<option value="id">ID</option>
								<option value="name">Name</option>
								<option value="email">Email</option>
								<option value="mobile">Mobile</option>
							</select>
							@endif
						
						    @if(isset($order))
							<select name="order" id="sorting">
								
								<option value="DESC" <?php if($order==="DESC") echo "selected";?>>DESC</option>
								<option value="ASC" <?php if($order==="ASC") echo "selected";?>>ASC</option>
							</select>
							@else
								<select name="order" id="sorting">
								<option value="DESC">DESC</option>
								<option value="ASC">ASC</option>
							</select>
							
							@endif
						</div>
					</form> 
					<div class="col-lg-12 col-md-12 all-action-section">
						<button class="btn btn-primary btn-sm delete_all" data-url="{{ url('phonebooksDeleteAll') }}">Delete All Selected</button>
						<a class="btn btn-default btn-sm" id = "FormDeleteTime"  href="{{ route('contactupload') }}"> Upload Contact list</a>
						<a class="btn btn-info btn-sm" id = "FormDeleteTime"   href="{{ route('phonebooks.export') }} "> Export Contacts</a>
					</div>
				<!--<div class="ui-widget">
				  <label for="tags">Tags: </label>
				  <input id="tags">
				</div>-->
               
            </div>
			
            
        </div>
    </div>
	
    <table class="table table-bordered">
        <tr> 
           
            <th> <p><label><input type="checkbox" id="checkAll"/> Check all</label></p></th>
            <th>Sl</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Group</th>
            <th width="280px">Action</th>
        </tr>
	
    @foreach ($phonebooks as $phonebook)
	
    <tr id="tr_{{$phonebook->id}}"> 
        <td><input type="checkbox" name="checkbox[]" data-id="{{$phonebook->id}}" class="cb" /></td>
        <td>{{ ++$i }}</td>
        <td>{{ $phonebook->name}}</td>
        <td>{{ $phonebook->mobile}}</td>
        <td>{{ $phonebook->email}}</td>
        <td>{{ $phonebook->contact_group}}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('phonebooks.show',$phonebook->id) }}">Show</a>
            <a class="btn btn-primary btn-sm" href="{{ route('phonebooks.edit',$phonebook->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['phonebooks.destroy', $phonebook->id], 'onsubmit' => 'return confirm("are you sure ?")', 'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $phonebooks->render() !!}
@endsection