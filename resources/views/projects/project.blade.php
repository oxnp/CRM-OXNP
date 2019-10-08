@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="row">
    <div class="col-md-4">
    Project data
        <form action="{{route('projects.update',$project['id'])}}" name="project_update" method="POST">
            <label class="control-label">name</label>
            <input class="form-control" name="name" value="{{$project['name']}}"/>

            <label class="control-label">price</label>
            <select name="price" class="form-control">
                <option value="Hourly" @if($project['price'] == 'Hourly') selected @endif>Hourly</option>
                <option value="Fixed" @if($project['price'] == 'Fixed') selected @endif>Fixed</option>
            </select>

            <label class="control-label">status</label>
            <select class="form-control" name="status_id">
                @foreach($project_statuses as $status)
                    <option value="{{$status['id']}}" @if($status['id'] == $project['status_id']) selected @endif>{{$status['name_status']}}</option>
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
            <textarea class="form-control" name="accesses" >{{$project['accesses']}}</textarea>

         <!--   <input type="hidden" name="participants_id" value="{{$project['participants_id']}}"> -->
            <label class="control-label">participants</label>
            <select name="participants_id[]" multiple class="form-control">
                @php $participants = explode(',',$project['participants_id']); @endphp
                @foreach($users as $user)
                    <option value="{{$user['id']}}" @if(in_array($user['id'],$participants)) selected @endif>{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>

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
    <div class="col-md-4 hide">
    Participants
    <ul>
        @foreach($participants_user as $user)
            <li data-attr="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</li>
        @endforeach
    </ul>
    </div>
        <div class="col-md-4 hide">
            All user
            <select name="users" multiple class="form-control">
                @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            Participants
            <table width="100%">
                <thead>
                <tr><th>Position</th>
                    <th>Name</th>
                    <th>Track time</th>
                </tr>
                </thead>
                @foreach($total_time_for_project as $user_id => $user)
                    <tr data-attr="{{$user_id}}">
                        <td>{{$user['role']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['total_track_time']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>
    <div class="row">
    <div class="col-md-4">
        <div class="col-md-12">Attachment</div>
        @foreach($project_attachments as $attach)
            @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                <div class="col-md-3">
                    <img src="{{$attach['storage']}}" style="width:100%"/>
                </div>
            @endif
        @endforeach
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
        <form action="{{ route('projects_attachment_by_id',$project['id'])}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="files[]" multiple/>
            <input type="submit" value="Upload"/>
            @if($result_action['files_added'])
                Upload {{$result_action['files_added']}} files
            @endif
        </form>
    </div>
    </div>

@stop