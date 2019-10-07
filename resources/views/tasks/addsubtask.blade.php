@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="col-md-4">
        Parent Task {{$task['name']}}
    <form action="{{route('add_sub_task',[$project_id,$category_id,$task['id']])}}" method="POST" enctype="multipart/form-data">
        <label class="control-label">Name task</label>
        <input type="text" name="name"  class="form-control"/>

        <label class="control-label">Description</label>
        <input type="text" name="description"  class="form-control"/>

        <label class="control-label">sprint_id</label>
        <select type="text" name="sprint_id"  class="form-control">
            @foreach($sprints as $sprint)
                <option value="{{$sprint['id']}}">{{$sprint['name']}}</option>
            @endforeach
        </select>

        <label class="control-label">director_id</label>
        <select type="text" name="director_id"  class="form-control">
            @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>

        <label class="control-label">executor_id</label>
        <select type="text" name="executor_id"  class="form-control">
            @foreach($users_by_project as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
            @endforeach
        </select>
        <label class="control-label">date_start</label>
        <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="date_start"  class="form-control"/>

        <label class="control-label">dead_line</label>
        <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="dead_line"  class="form-control"/>

        <label class="control-label">status_id</label>
        <select type="text" name="status_id"  class="form-control">
            @foreach($tasks_statuses as $status)
                <option value="{{$status['id']}}">{{$status['name']}}</option>
            @endforeach
        </select>
        <label class="control-label">priority</label>
        <select type="text" name="priority_id"  class="form-control">
            @foreach($tasks_priority as $priority)
                <option value="{{$priority['id']}}">{{$priority['name']}}</option>
            @endforeach
        </select>

        <label class="control-label">time_estimate</label>
        <input type="text" name="time_estimate"  class="form-control"/>

        <label class="control-label">time_tracker</label>
        <input type="text" name="time_tracker"  class="form-control"/>
        <input type="file" name="files[]" multiple/>
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Add Task"/>
    </form>
    </div>
@stop