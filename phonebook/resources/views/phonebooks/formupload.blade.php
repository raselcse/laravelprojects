<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Upload CSV file with must two field  as header "Display Name" and "Mobile Phone" :</strong>
                {!! Form::file('contact_upload', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
				 {!! Form::token(); !!}
                 {!!   csrf_field() ; !!} 
				<input type = "hidden" name = "user_id" value = "{{Auth::user()->id}}">
            </div>
        </div>
		
		
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">upload</button>
        </div>
    </div>