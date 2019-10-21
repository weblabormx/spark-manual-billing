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
            {{__('Users')}}
            <a class="btn btn-sm btn-outline-dark float-right" href="/spark/kiosk/crud/users/create">
                {{__('Create new')}}
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-valign-middle mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>E-Mail Address</th>
                        <th>Teams</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{$user->photo_url}}" alt="User Photo" class="spark-profile-photo">
                            </td>
                            <td>
                                <div>{{$user->name}}</div>
                            </td>
                            <td>
                                <div>{{$user->email}}</div>
                            </td>
                            <td>
                                <div>
                                    <a href="/spark/kiosk/crud/teams?user_id={{$user->id}}">
                                        {{$user->teams_count}}    
                                    </a>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-default btn-sm" href="/spark/kiosk/#/users/{{$user->id}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-default btn-sm" href="/spark/kiosk/crud/users/{{$user->id}}/edit"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer pb-0">
            {{ $users->links() }}
        </div>
        
    </div>

@endsection
