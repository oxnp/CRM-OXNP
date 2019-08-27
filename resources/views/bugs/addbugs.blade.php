@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="col-md-4">
        <form action="{{route('add_bug',[$project_id,$category_id])}}" method="POST">
            <label class="control-label">name</label>
            <input name="name" class="form-control"/>

            <label class="control-label">description</label>
            <input name="description" class="form-control"/>

            <label class="control-label">steps</label>
            <input name="steps" class="form-control"/>

            <label class="control-label">wait result</label>
            <input name="wait_result" class="form-control"/>

            <label class="control-label">fact result</label>
            <input name="fact_result" class="form-control"/>

            <label class="control-label">director_id</label>
            <select type="text" name="director_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>

            <label class="control-label">executor_id</label>
            <select type="text" name="executor_id" class="form-control">
                @foreach($users_by_project as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>

            <label class="control-label">dead line</label>
            <input name="dead_line" class="form-control"/>

            <label class="control-label">priority_id</label>
            <select type="text" name="priority_id" class="form-control">
                @foreach($bugs_priorities as $priority)
                    <option value="{{$priority['id']}}">{{$priority['name']}}</option>
                @endforeach
            </select>

            <label class="control-label">status_id</label>
            <select type="text" name="status_id" class="form-control">
                @foreach($bugs_statuses as $status)
                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                @endforeach
            </select>

            <label class="control-label">sprint_id</label>
            <input name="sprint_id" class="form-control"/>

            <label class="control-label">arounds</label>
            <input name="arounds" class="form-control"/>

            {{csrf_field()}}
            <input type="submit" class="form-control btn btn-primary" value="Add Bug"/>
        </form>
    </div>
@stop