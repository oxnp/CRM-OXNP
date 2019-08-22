@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@section('content')
    <div class="col-md-4">
    <form action="{{route('tasks_add',[$project_id,$category_id])}}" method="POST">
        <label class="control-label">Name task</label>
        <input type="text" name="name"  class="form-control"/>

        <label class="control-label">Description</label>
        <input type="text" name="description"  class="form-control"/>

        <label class="control-label">sprint_id</label>
        <input type="text" name="sprint_id"  class="form-control"/>

        <label class="control-label">executor_id</label>
        <input type="text" name="executor_id"  class="form-control"/>

        <label class="control-label">dead_line</label>
        <input type="text" name="dead_line"  class="form-control"/>

        <label class="control-label">status_id</label>
        <input type="text" name="status_id"  class="form-control"/>

        <label class="control-label">priority</label>
        <input type="text" name="priority_id"  class="form-control"/>

        <label class="control-label">time_estimate</label>
        <input type="text" name="time_estimate"  class="form-control"/>

        <label class="control-label">time_tracker</label>
        <input type="text" name="time_tracker"  class="form-control"/>

        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Add Task"/>
    </form>
    </div>
@stop