@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					<a class="btn btn-link" href="/phonebooks/create">
					Add contact
					 </a>
					 
					<a class="btn btn-link" href="/phonebooks">
						Contacts List 
					 </a>
					
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
