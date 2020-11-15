@extends('spark-manual-billing::spark.kiosk-layout', ['is_ajax' => false])
@section('content-inside')

    <div class="card card-default" style="border: 0px;">
        <div class="card-body">
            {!! Form::open(['url' => request()->url(), 'method' => 'get']) !!}
                {!! Form::text('search', null, ['placeholder' => __('Search'), 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                {!! Form::submit(__('Search'), ['class'=>'btn btn-sm btn-outline-dark position-absolute', 'style' => 'top: 25px; right: 25px;']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header">
            {{__('Teams')}}
        </div>
        <div class="table-responsive">
            <table class="table table-valign-middle mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Owner')}}</th>
                        <th>{{__('Subscription')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>
                                <img src="{{$team->photo_url}}" alt="Team Photo" class="spark-profile-photo">
                            </td>
                            <td>
                                <div>{{$team->name}}</div>
                            </td>
                            <td>
                                <div>
                                    <a href="/spark/kiosk/#/users/{{$team->owner->id}}">
                                        {{$team->owner->name}}    
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div>
                                    {{$team->plan_name}}
                                    @isset($team->plan_date)
                                        <br />
                                        <small>{{__('Until')}} {{$team->plan_date}}</small>
                                    @endisset
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-default btn-sm" href="/spark/kiosk/crud/teams/{{$team->id}}/edit" title="{{__('Configure subscription')}}"><i class="fa fa-credit-card"></i></a>
                                @if(!$team->subscribed())
                                    <a class="btn btn-default btn-sm" href="/spark/kiosk/crud/teams/{{$team->id}}/free-trial" title="{{__('Extend Free Trial')}}"><i class="fa fa-gift"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $teams->links() }}
        </div>
        
    </div>

@endsection
