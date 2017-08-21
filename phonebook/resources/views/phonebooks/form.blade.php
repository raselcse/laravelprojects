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
                <strong>Mobile:</strong>
                {!! Form::text('mobile', null, array('placeholder' => 'Mobile','class' => 'form-control')) !!}
				
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
				<strong>Group:</strong>
				{!! Form::select('contact_group', array('family' => 'Family', 'friend' => 'Friend', 'colleague' => 'Colleague', 'others' => 'Others')) !!}
			</div>
        </div>
		
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {!! Form::textarea('details', null, array('placeholder' => 'Details','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>