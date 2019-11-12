@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
    <div class="top_panel">
        <div class="heading"><i class="fas fa-user-circle"></i>Сотрудники</div>
    </div>
    <div class="t_content">
        <div class="thead">
            <div class="col-md-6">Имя</div>
            <div class="col-md-6">Должность</div>
        </div>
        <div class="tbody">
            @foreach($users as $user)
                <div class="t_row">
                    <div class="col-md-6">
                        <a href="{{route('users.show',$user['id'])}}">{{$user['name']}}</a>
                    </div>
                    <div class="col-md-6">
                        {{$user['role_name']}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop