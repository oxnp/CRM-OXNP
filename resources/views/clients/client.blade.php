@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
    <div class="top_panel">
        <div class="heading"><i class="fas fa-user-circle"></i>{{$client['first_name']}} {{$client['last_name']}}
            ({{$client['country']}})
        </div>
    </div>
    <form action="{{route('clients.update',$client['id'])}}" name="client_update" method="POST">
        <div class="divided row">
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <a class="edit_fields">
                        <i class="far fa-edit"></i>
                    </a>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>first_name</label>
                        </div>
                        <div class="col-md-7">
                            <input disabled="disabled" name="first_name" value="{{$client['first_name']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>last_name</label>
                        </div>
                        <div class="col-md-7">
                            <input disabled="disabled" name="last_name" value="{{$client['last_name']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>country</label>
                        </div>
                        <div class="col-md-7">
                            <input disabled="disabled" name="country" value="{{$client['country']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>timezone</label>
                        </div>
                        <div class="col-md-7">
                            <select disabled="disabled" name="timezone">
                                @for($i=-8;$i<=12;$i++)
                                    @if($i<0)
                                        <option value="GMT{{$i}}"
                                                @if($client['timezone'] == 'GMT'.$i.'') selected @endif >
                                            GMT{{$i}}</option>
                                    @else
                                        <option value="GMT+{{$i}}"
                                                @if($client['timezone'] == 'GMT+'.$i.'') selected @endif >
                                            GMT+{{$i}}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>manager</label>
                        </div>
                        <div class="col-md-7">
                            <select disabled="disabled" name="manager_id">
                                @foreach($users as $user)
                                    @if ($user['role_id'] == env('MANAGER_ROLE_ID'))
                                        <option value="{{$user['id']}}"
                                                @if($user['id'] == $client['manager_id']) selected @endif>{{$user['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>comm_status</label>
                        </div>
                        <div class="col-md-7">
                            <select disabled="disabled" name="comm_status_id">
                                @foreach($clients_statuses as $status)
                                    <option value="{{$status['id']}}"
                                            @if($status['id'] == $client['comm_status_id']) selected @endif>{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>trust</label>
                        </div>
                        <div class="col-md-7">
                            <select disabled="disabled" name="trust_id">
                                @foreach($clients_trust as $trust)
                                    <option value="{{$trust['id']}}"
                                            @if($trust['id'] == $client['trust_id']) selected @endif>{{$trust['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>who join</label>
                        </div>
                        <div class="col-md-7">
                            <select disabled="disabled" name="who_join_user_id">
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}"
                                            @if($user['id'] == $client['who_join_user_id']) selected @endif>{{$user['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <a class="edit_fields">
                        <i class="far fa-edit"></i>
                    </a>
                    <div class="inp_head col-md-12">
                        Контактные данные
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>email</label>
                        </div>
                        <div class="col-md-7">
                            <input disabled="disabled" name="email" value="{{$client['email']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>messanger</label>
                        </div>
                        <div class="col-md-7">
                            <input disabled="disabled" name="messanger" value="{{$client['messanger']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-12">
                            <label>description_client</label>
                        </div>
                        <div class="col-md-12">
                            <textarea rows="5" disabled="disabled" name="description_client">{{$client['description_client']}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <a class="edit_fields">
                        <i class="far fa-edit"></i>
                    </a>
                    <div class="inp">
                        <div class="col-md-12">
                            <label>other_info</label>
                        </div>
                        <div class="col-md-12">
                            <textarea rows="13" disabled="disabled" name="other_info">{{$client['other_info']}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @if($projects_by_client)
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <div class="inp_head col-md-12">
                        Список проектов
                    </div>
                    <ul class="cl_projects">
                        @foreach($projects_by_client as $project)
                            <li><a href="{{route('projects.show',$project['id'])}}">{{$project['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <input name="_method" type="hidden" value="PUT">
            {{csrf_field()}}
            <!--<input type="submit" class="form-control btn btn-primary" value="Save"/>-->
        </div>
    </form>
@stop