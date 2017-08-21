<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::file('contact_upload', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
				<input type = "hidden" name = "user_id" value = "{{Auth::user()->id}}">
            </div>
        </div>
		
		
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">upload</button>
        </div>
    </div>