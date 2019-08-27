@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="col-md-4">
    <form action="{{route('tasks_update',[$project_id,$category_id,$task['id']])}}" method="POST">
        <label class="control-label">Name task</label>
        <input type="text" name="name"  class="form-control" value="{{$task['name']}}"/>

        <label class="control-label">Description</label>
        <input type="text" name="description"  class="form-control" value="{{$task['description']}}"/>

        <label class="control-label">sprint_id</label>
        <input type="text" name="sprint_id"  class="form-control" value="{{$task['sprint_id']}}"/>

        <label class="control-label">director_id</label>
        <select type="text" name="director_id"  class="form-control">
            @foreach($users as $user)
                <option value="{{$user['id']}}"  @if($task['director_id'] == $user['id']) selected @endif>{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>

        <label class="control-label">executor_id</label>
        <select type="text" name="executor_id"  class="form-control">
            @foreach($users_by_project as $user)
                <option value="{{$user['id']}}" @if($task['executor_id'] == $user['id']) selected @endif >{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>

        <label class="control-label">dead_line</label>
        <input type="text" name="dead_line"  class="form-control" value="{{$task['dead_line']}}"/>

        <label class="control-label">status_id</label>
        <select type="text" name="status_id"  class="form-control">
            @foreach($tasks_statuses as $status)
                <option value="{{$status['id']}}" @if($task['status_id'] == $status['id']) selected @endif >{{$status['name']}}</option>
            @endforeach
        </select>
        <label class="control-label">priority</label>
        <select type="text" name="priority_id"  class="form-control">
            @foreach($tasks_priority as $priority)
                <option value="{{$priority['id']}}"  @if($task['priority_id'] == $priority['id']) selected @endif >{{$priority['name']}}</option>
            @endforeach
        </select>
        <label class="control-label">time_estimate</label>
        <input type="text" name="time_estimate"  class="form-control" value="{{$task['time_estimate']}}"/>

        <label class="control-label">time_tracker</label>
        <input type="text" name="time_tracker"  class="form-control" value="{{$task['time_tracker']}}"/>
        <input name="_method" type="hidden" value="PUT">
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Save"/>
    </form>
        <div class="row">

                <div class="col-md-12">Attachment</div>
                @foreach($tasks_attachemnts as $attach)
                    @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                        <div class="col-md-3">
                            <img src="{{$attach['storage']}}" style="width:100%"/>
                        </div>
                    @endif
                @endforeach

        </div>
        <form action="{{ route('tasks_attachment_by_id',[$project_id,$task['id']])}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="files[]" multiple/>
            <input type="submit" value="Upload"/>
            @if($result_action['files_added'])
                Upload {{$result_action['files_added']}} files
            @endif
        </form>
    </div>
@stop