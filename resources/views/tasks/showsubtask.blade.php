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
        <label class="control-label">sprint_id</label>
        <select type="text" name="sprint_id"  class="form-control">
            @foreach($sprints as $sprint)
                <option value="{{$sprint['id']}}" @if($task['sprint_id'] == $sprint['id']) selected @endif>{{$sprint['name']}}</option>
            @endforeach
        </select>

        <label class="control-label">executor_id</label>
        <select type="text" name="director_id"  class="form-control">
            @foreach($users as $user)
                <option value="{{$user['id']}}" @if($task['director_id'] == $user['id']) selected @endif >{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>

        <label class="control-label">executor_id</label>
        <select type="text" name="executor_id"  class="form-control">
            @foreach($users_by_project as $user)
                <option value="{{$user['id']}}" @if($task['executor_id'] == $user['id']) selected @endif >{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>

        <label class="control-label">date_start</label>
        <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="date_start"  class="form-control" value="{{$task['date_start']}}"/>

        <label class="control-label">dead_line</label>
        <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="dead_line"  class="form-control" value="{{$task['dead_line']}}"/>

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
        <input type="submit" class="form-control btn btn-primary" value="Add Task"/>
    </form>
        <div class="row">
            <div class="col-md-12">Attachment</div>
            @foreach($task_attachemnts as $attach)
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
    <div class="col-md-4">

        <table>
            <thead>
            <th>Name</th>
            <th>Track time</th>
            <th>Action</th>
            </thead>
            @foreach($schedules as $schedule)
                <tr>
                    <td width="80px">{{$schedule['name']}}</td>
                    <td width="80px">{{$schedule['total_time']}}</td>
                    <td>@if($schedule['user_id'] == Auth::user()->id && $schedule['flag_in_progress_th'] == 1) {{$curr_track_for_task}}
                        <form  method = "POST"  name = "stop_tracker" action = "{{route('stop_track',[$category_id,$task['id'],$schedule['id'],'task'])}}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="PUT">
                            <input type="submit" value="stop">
                        </form>

                        @endif</td>
                </tr>
            @endforeach
        </table>
        <form  method = "POST"  name = "start_tracker" action = "{{route('start_track',[$project_id,$task['id'],'task'])}}">
            {{csrf_field()}}
            <input type="submit" value="start">
        </form>
    </div>
@stop