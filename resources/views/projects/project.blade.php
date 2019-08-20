@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@section('content')
    <div class="row">
    <div class="col-md-4">
    Project data
        <form action="{{route('projects_update',$project['id'])}}" name="project_update" method="POST">
            <label class="control-label">name</label>
            <input class="form-control" name="name" value="{{$project['name']}}"/>

            <label class="control-label">price</label>
            <select name="price"class="form-control">
                <option value="Hour" @if($project['price'] == 'Hour') selected @endif>Hour</option>
                <option value="Fixed" @if($project['price'] == 'Fixed') selected @endif>Fixed</option>
            </select>

            <label class="control-label">status</label>
            <select class="form-control" name="status_id">
                @foreach($project_statuses as $status)
                    <option value="{{$status->id}}" @if($status->id == $project['status_id']) selected @endif>{{$status->name_status}}</option>
                @endforeach
            </select>

            <label class="control-label">date_start</label>
            <input class="form-control" name="date_start" value="{{$project['date_start']}}"/>

            <label class="control-label">date_end</label>
            <input class="form-control" name="date_end" value="{{$project['date_end']}}"/>

            <label class="control-label">description</label>
            <input class="form-control" name="description" value="{{$project['description']}}"/>

            <label class="control-label">curr_website</label>
            <input class="form-control" name="curr_website" value="{{$project['curr_website']}}"/>

            <label class="control-label">old_website</label>
            <input class="form-control" name="old_website" value="{{$project['old_website']}}"/>

            <label class="control-label">accesses</label>
            <input class="form-control" name="accesses" value="{{$project['accesses']}}"/>

            <input type="hidden" name="participants_id" value="{{$project['participants_id']}}">
            <input name="_method" type="hidden" value="PUT">
            {{csrf_field()}}
            <input type="submit" class="form-control btn btn-primary" value="Save"/>
        </form>

    </div>
    <div class="col-md-4">
Client data
    <ul>
        @foreach($client as $key=>$val)
            <li><b>{{$key}}:</b> {{$client[$key]}}</li>
        @endforeach
    </ul>
    </div>
    <div class="col-md-4">
    Participants
    <ul>
        @foreach($participants_user as $user)
            <li data-attr="{{$user['id']}}">{{$user['name']}} - {{$user['position']}}</li>
        @endforeach
    </ul>
    </div>
        <div class="col-md-4">
            All user
            <select name="users" multiple class="form-control">
                @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['position']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12">Attachment</div>
        @foreach($project_attachemnts as $attach)
            @if($attach['type_file'] == 'image')
                <div class="col-md-3">
                <img src="{{$attach['storage']}}" style="width:100%"/>
                </div>
            @endif
        @endforeach
    </div>

@stop