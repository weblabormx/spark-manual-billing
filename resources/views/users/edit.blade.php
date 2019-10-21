@extends('spark-manual-billing::spark.kiosk-layout', ['is_ajax' => false])
@section('content-inside')
    
    @include('flash::message')
    @include('spark-manual-billing::errors')
    <div class="card card-default">
        <div class="card-header">
            {{__('Edit User')}}
        </div>
        <div class="card-body">
            {!! Form::model($user, ['url' => '/spark/kiosk/crud/users/'.$user->id, 'method' => 'PUT']) !!}
                @include('spark-manual-billing::users.partial-form')
                <div class="form-group row">
                    <div class="offset-md-4 col-md-6">
                        {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
