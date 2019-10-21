@extends('spark-manual-billing::spark.kiosk-layout', ['is_ajax' => false])
@section('content-inside')

    <div class="card card-default" style="border: 0px;">
        <div class="card-body">
            {!! Form::open(['url' => request()->url(), 'method' => 'get']) !!}
                {!! Form::text('search', null, ['placeholder' => 'Search', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                {!! Form::submit('Search', ['class'=>'btn btn-sm btn-outline-dark position-absolute', 'style' => 'top: 25px; right: 25px;']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header">
            {{__('Teams ')}}
        </div>
        <div class="table-responsive">
            <table class="table table-valign-middle mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Subscription</th>
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
                                <div>{{$team->status_title}}</div>
                            </td>
                            <td>
                                @if(!Str::contains($team->status_title, 'Active'))
                                    <a class="btn btn-default btn-sm" href="/spark/kiosk/crud/teams/{{$team->id}}/edit" title="Configure subscription"><i class="fa fa-credit-card"></i></a>
                                    @if(!Str::contains($team->status_title, 'Subscribed'))
                                        <a class="btn btn-default btn-sm" href="/spark/kiosk/crud/teams/{{$team->id}}/free-trial" title="Extend Free Trial"><i class="fa fa-gift"></i></a>
                                    @endif
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
