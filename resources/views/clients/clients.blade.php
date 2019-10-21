@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
    <div class="top_panel">
        <div class="heading"><i class="fas fa-user-circle"></i>Список клиентов</div>
    </div>
    <div class="t_content">
        <div class="thead">
            <div class="col-md-2">Имя</div>
            <div class="col-md-2">Страна</div>
            <div class="col-md-2">Таймзона</div>
            <div class="col-md-2">Сейлз</div>
            <div class="col-md-2">Проджект</div>
            <div class="col-md-2">Статус</div>
        </div>
        <div class="tbody">
            @foreach($clients as $client)
                <div class="t_row">
                    <div class="col-md-2">
                        <a href="{{route('clients.show',$client['id'])}}">{{$client['first_name']}} {{$client['last_name']}}</a>
                    </div>
                    <div class="col-md-2">{{$client['country']}}</div>
                    <div class="col-md-2">{{$client['timezone']}}</div>
                    <div class="col-md-2">{{$client['who_join']}}</div>
                    <div class="col-md-2">{{$client['manager']}}</div>
                    <div class="col-md-2">{{$client['status']}}</div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="mod" tabindex="-1" role="dialog" aria-labelledby="mod"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    Добавление клиента
                </div>
                <div class="modal-body">
                    <form action="{{route('clients.store')}}" name="client_add" method="POST">
                        <label class="control-label">first_name</label>
                        <input class="form-control" name="first_name"/>
                        <label class="control-label">last_name</label>
                        <input class="form-control" name="last_name"/>
                        <label class="control-label">country</label>
                        <input class="form-control" name="country"/>
                        <label class="control-label">timezone</label>
                        <select class="form-control" name="timezone">
                            @for($i=-8;$i<=12;$i++)
                                @if($i<0)
                                    <option value="GMT{{$i}}">GMT{{$i}}</option>
                                @else
                                    <option value="GMT+{{$i}}">GMT+{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                        <label class="control-label">email</label>
                        <input class="form-control" name="email"/>
                        <label class="control-label">messanger</label>
                        <input class="form-control" name="messanger"/>
                        <label class="control-label">description_client</label>
                        <input class="form-control" name="description_client"/>
                        <label class="control-label">other_info</label>
                        <input class="form-control" name="other_info"/>
                        <label class="control-label">comm_status</label>
                        <select class="form-control" name="comm_status_id">
                            @foreach($clients_statuses as $status)
                                <option value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                        <label class="control-label">trust</label>
                        <select class="form-control" name="trust_id">
                            @foreach($clients_trust as $trust)
                                <option value="{{$trust['id']}}">{{$trust['name']}}</option>
                            @endforeach
                        </select>
                        <label class="control-label">who join</label>
                        <select class="form-control" name="who_join_user_id">
                            @foreach($users as $user)
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>

                        <label class="control-label">manager </label>
                        <select class="form-control" name="manager_id">
                            @foreach($users as $user)
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>
                        {{csrf_field()}}
                        <input type="submit" class="form-control btn btn-primary" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop