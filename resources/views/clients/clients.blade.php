@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@section('content')
    <div class="col-md-3">
    <form action="{{route('clients_add')}}" name="client_add" method="POST">
        <label class="control-label">first_name</label>
        <input class="form-control" name="first_name"/>
        <label class="control-label">last_name</label>
        <input class="form-control" name="last_name"/>
        <label class="control-label">country</label>
        <input class="form-control" name="country"/>
        <label class="control-label">timezone</label>
        <select class="form-control" name="timezone">
            @for($i=-8;$i<=12;$i++)
                @if($i<0)
                    <option value="(GMT{{$i}})">(GMT{{$i}})</option>
                    @else
                    <option value="(GMT+{{$i}})">(GMT+{{$i}})</option>
                @endif
            @endfor
        </select>
        <label class="control-label">email</label>
        <input class="form-control" name="email"/>
        <label class="control-label">messanger</label>
        <input class="form-control" name="messanger"/>
        <label class="control-label">description_client</label>
        <input class="form-control" name="description_client"/>
        <label class="control-label">other_info</label>
        <input class="form-control" name="other_info"/>
        <label class="control-label">comm_status</label>
        <select class="form-control" name="comm_status_id">
            @foreach($clients_statuses as $status)
                <option value="{{$status['id']}}">{{$status['name']}}</option>
                @endforeach
        </select>
        <label class="control-label">trust</label>
        <select class="form-control" name="trust_id">
            @foreach($clients_trust as $trust)
                <option value="{{$trust['id']}}">{{$trust['name']}}</option>
            @endforeach
        </select>
        <label class="control-label">who join</label>
        <select class="form-control" name="who_join_user_id">
            @foreach($users as $user)
                <option value="{{$user['id']}}">{{$user['name']}}</option>
            @endforeach
        </select>
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Save"/>
    </form>
    </div>
    <div class="col-md-3">
    <ul>
    @foreach($clients as $client)
            <li><a href="{{route('clients_detail',$client['id'])}}">{{$client['first_name']}} {{$client['last_name']}}</a></li>
    @endforeach
    </ul>
    </div>
@stop