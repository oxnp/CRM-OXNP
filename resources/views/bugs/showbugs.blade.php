@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="col-md-4">
        <form action="{{route('update_bug',[$project_id,$category_id,$bug['id']])}}" method="POST">
            <label class="control-label">name</label>
            <input name="name" value="{{$bug['name']}}"  class="form-control"/>

            <label class="control-label">description</label>
            <input name="description" value="{{$bug['description']}}"  class="form-control"/>

            <label class="control-label">steps</label>
            <input name="steps" value="{{$bug['steps']}}"  class="form-control"/>

            <label class="control-label">wait result</label>
            <input name="wait_result" value="{{$bug['wait_result']}}"  class="form-control"/>

            <label class="control-label">fact result</label>
            <input name="fact_result" value="{{$bug['fact_result']}}"  class="form-control"/>

            <label class="control-label">director_id</label>
            <select type="text" name="director_id"  class="form-control">
                @foreach($users as $user)
                        <option value="{{$user['id']}}" @if($bug['director_id'] == $user['id']) selected @endif >{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>

            <label class="control-label">executor_id</label>
            <select type="text" name="executor_id"  class="form-control">
                @foreach($users_by_project as $user)
                        <option value="{{$user['id']}}" @if($bug['executor_id'] == $user['id']) selected @endif >{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>

            <label class="control-label">dead line</label>
            <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="dead_line"  class="form-control"  value="{{$bug['dead_line']}}"/>

            <label class="control-label">time_tracker</label>
            <input type="text" name="time_tracker"  class="form-control"  value="{{$bug['time_tracker']}}"/>

            <label class="control-label">time_estimate</label>
            <input type="text" name="time_estimate"  class="form-control"  value="{{$bug['time_estimate']}}"/>

            <label class="control-label">priority_id</label>
            <select type="text" name="priority_id" class="form-control">
                @foreach($bugs_priorities as $priority)
                    <option value="{{$priority['id']}}" @if($bug['priority_id'] == $priority['id']) selected @endif>{{$priority['name']}}</option>
                @endforeach
            </select>

            <label class="control-label">status_id</label>
            <select type="text" name="status_id" class="form-control">
                @foreach($bugs_statuses as $status)
                    <option value="{{$status['id']}}" @if($bug['status_id'] == $status['id']) selected @endif>{{$status['name']}}</option>
                @endforeach
            </select>

            <label class="control-label">sprint_id</label>
            <select type="text" name="sprint_id"  class="form-control">
                @foreach($sprints as $sprint)
                    <option value="{{$sprint['id']}}"  @if($bug['sprint_id'] == $sprint['id']) selected @endif>{{$sprint['name']}}</option>
                @endforeach
            </select>

            <label class="control-label">arounds</label>
            <input name="arounds" value="{{$bug['arounds']}}"  class="form-control"/>
            <input name="_method" type="hidden" value="PUT">
            {{csrf_field()}}
            <input type="submit" class="form-control btn btn-primary" value="Update bug"/>
        </form>
        <div class="row">
            <div class="col-md-12">Attachment</div>
            @foreach($bugs_attachments as $attach)
                @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                    <div class="col-md-3">
                        <img src="{{$attach['storage']}}" style="width:100%"/>
                    </div>
                @endif
            @endforeach
        </div>
        <form action="{{ route('bugs_attachment_by_id',[$project_id,$bug['id']])}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="files[]" multiple/>
            <input type="submit" value="Upload"/>
            @if($result_action['files_added'])
                Upload {{$result_action['files_added']}} files
            @endif
        </form>
    </div>
    <div class="col-md-4">
        all my time to task {{$sum_my_time_for_task}}
        @if ($flag_track)
            <form  method = "POST"  name = "stop_tracker" action = "{{route('stop_track',[$category_id,$bug['id'],$schedule_track_id,'bug'])}}">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" value="stop">
            </form>
        @else
            <form  method = "POST"  name = "start_tracker" action = "{{route('start_track',[$project_id,$bug['id'],'bug'])}}">
                {{csrf_field()}}
                <input type="submit" value="start">
            </form>
        @endif




        <table>
            <thead>
            <th>Name</th>
            <th>Track time</th>
            <th>Action</th>
            </thead>
            @foreach($schedules as $schedule)
                <tr>
                    <td width="80px">{{$schedule['name']}}</td>
                    <td width="80px">@if($schedule['user_id'] == Auth::id() && $schedule['flag_in_progress_th'] == 1) {{$curr_track_for_task}} @else {{$schedule['total_time']}}@endif</td>
                    <td>@if($schedule['user_id'] == Auth::id() && $schedule['flag_in_progress_th'] == 1)
                        <!--<form  method = "POST"  name = "stop_tracker" action = "{{route('stop_track',[$category_id,$bug['id'],$schedule['id'],'bug'])}}">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="PUT">
                                <input type="submit" value="stop">
                            </form> -->

                        @endif</td>
                </tr>
            @endforeach
        </table>

    </div>
@stop