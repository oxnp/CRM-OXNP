@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@section('content')
    <div class="row">
        <div class="col-md-4">
            Project data
            <form action="{{route('projects_add')}}" name="project_add" method="POST"  enctype="multipart/form-data">
                <label class="control-label">name</label>
                <input class="form-control" name="name"/>

                <label class="control-label">price</label>
                <select name="price" class="form-control">
                    <option value="Hourly">Hourly</option>
                    <option value="Fixed">Fixed</option>
                </select>

                <label class="control-label">status</label>
                <select class="form-control" name="status_id">
                    @foreach($project_statuses as $status)
                        <option value="{{$status['id']}}">{{$status['name_status']}}</option>
                    @endforeach
                </select>
                <label class="control-label">client</label>
                <select name="client_id" class="form-control">
                    @foreach($clients as $client)
                        <option value="{{$client['id']}}">{{$client['first_name']}} - {{$client['last_name']}}</option>
                    @endforeach
                </select>
                <label class="control-label">date_start</label>
                <input class="form-control" name="date_start"/>

                <label class="control-label">date_end</label>
                <input class="form-control" name="date_end"/>

                <label class="control-label">description</label>
                <input class="form-control" name="description"/>

                <label class="control-label">curr_website</label>
                <input class="form-control" name="curr_website"/>

                <label class="control-label">old_website</label>
                <input class="form-control" name="old_website"/>

                <label class="control-label">accesses</label>
                <input class="form-control" name="accesses"/>

                <label class="control-label">participant_id(1,2,3,4)</label>
                <!--<input class="form-control" type="text" name="participants_id"/> -->
                <select name="participants_id[]" multiple class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
                    @endforeach
                </select>
                <input type="file" name="files[]" multiple/>
                {{csrf_field()}}


                <input type="submit" class="form-control btn btn-primary" value="Save"/>
            </form>

        </div>
        <div class="col-md-4 hide">
            All user
            <select name="users" multiple class="form-control">
                @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['role_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
@stop