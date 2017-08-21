<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
				<input type = "hidden" name = "user_id" value = "{{Auth::user()->id}}">
            </div>
        </div>
		
		
		
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
                <strong>email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
				
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
                <strong>User Type:</strong>
                {!! Form::select('type', array('admin' => 'Admin', 'normal' => 'Normal'))!!}
			</div>
        </div>
		
		
	
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>