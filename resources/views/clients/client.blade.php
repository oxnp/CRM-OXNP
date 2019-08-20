@extends('layouts.default')
@extends('layouts.projects-list-sidebar')

@section('content')
    <div class="col-md-6">
        Info project
    <form action="{{route('clients_update',$client['id'])}}" name="client_update" method="POST">

        @foreach($client as $key=>$val)
            @if ($key != 'id' && $key != 'comm_status_id' && $key != 'trust_id' && $key != 'who_join_user_id' && $key != 'created_at' && $key != 'updated_at')
                <label class="control-label">{{$key}}</label>
                <input class="form-control" name="{{$key}}" value="{{$client[$key]}}"/>
            @endif
        @endforeach
            <label class="control-label">comm_status</label>
            <select class="form-control" name="comm_status_id">
                @foreach($clients_statuses as $status)
                    <option value="{{$status->id}}" @if($status->id == $client['comm_status_id']) selected @endif>{{$status->name}}</option>
                @endforeach
            </select>
            <label class="control-label">trust</label>
            <select class="form-control" name="trust_id">
                @foreach($clients_trust as $trust)
                    <option value="{{$trust->id}}" @if($trust->id == $client['trust_id']) selected @endif>{{$trust->name}}</option>
                @endforeach
            </select>
            <label class="control-label">who join</label>
            <select class="form-control" name="who_join_user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}" @if($user->id == $client['who_join_user_id']) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
            <input name="_method" type="hidden" value="PUT">
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Save"/>
    </form>
    </div>
    <div class="col-md-6">
    Projects by client
        <ul>
            @foreach($projects_by_client as $project)
                <li><a href="{{route('projects_detail',$project['id'])}}">{{$project['name']}}</a></li>
            @endforeach
        </ul>
    </div>
@stop