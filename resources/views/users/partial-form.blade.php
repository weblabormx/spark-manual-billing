<div class="form-group row">
    <label for="announcement" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="action_text" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label> 
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="action_url" class="col-md-4 col-form-label text-md-right">{{__('Password')}}</label>
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>
