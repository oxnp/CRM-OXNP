@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
    <table width="500px">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Должность</th>
        </tr>
        </thead>
        @foreach($users as $user)
            <tr>
                <td><a href="{{route('users.show',$user['id'])}}">{{$user['name']}}</a></td>
                <td>{{$user['role_name']}}</td>
            </tr>
            @endforeach
    </table>
@stop