@extends('spark-manual-billing::spark.kiosk-layout', ['is_ajax' => false])
@section('content-inside')
    
    @include('flash::message')
    @include('spark-manual-billing::errors')
    <div class="card card-default">
        <div class="card-header">
            {{__('Configure subscription')}} - {{$team->name}}
        </div>
        <div class="card-body">
            {!! Form::model($team, ['url' => '/spark/kiosk/crud/teams/'.$team->id, 'method' => 'PUT']) !!}
                <div class="form-group row">
                    <label for="announcement" class="col-md-4 col-form-label text-md-right">{{__('Plan')}}</label>
                    <div class="col-md-6">
                        {!! Form::select('plan', Laravel\Spark\Spark::teamPlans()->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="action_text" class="col-md-4 col-form-label text-md-right">{{__('Total')}}</label> 
                    <div class="col-md-6">
                        {!! Form::number('total', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="action_url" class="col-md-4 col-form-label text-md-right">{{__('Duration on days')}}</label>
                    <div class="col-md-6">
                        {!! Form::number('days', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-md-4 col-md-6">
                        {!! Form::submit(__('Add subscription'), ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
