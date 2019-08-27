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
            <input name="dead_line" value="{{$bug['dead_line']}}"  class="form-control"/>

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
            <input name="sprint_id" value="{{$bug['sprint_id']}}"  class="form-control"/>

            <label class="control-label">arounds</label>
            <input name="arounds" value="{{$bug['arounds']}}"  class="form-control"/>
            <input name="_method" type="hidden" value="PUT">
            {{csrf_field()}}
            <input type="submit" class="form-control btn btn-primary" value="Update bug"/>
        </form>

    </div>
@stop