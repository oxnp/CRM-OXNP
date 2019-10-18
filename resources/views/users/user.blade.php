@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
    <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
               aria-selected="true">Карточка сотрудника</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
               aria-selected="false">Другая инфа</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
               aria-selected="false">Материалные ценности</a>
        </li>
    </ul>
    <div class="tab-content card pt-5" id="myTabContentMD">
        <div class="tab-pane fade show active in" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
            <form action="{{route('users.store')}}" method="POST">
                <input type="file" name="avatar"/>
                <label>Name</label>
                <input type="text" name="name" value="{{$user[0]['name']}}" class="form-control"/>
                <label>Role</label>
                <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{$role['role_id']}}" @if($user[0]['role_id'] == $role['role_id']) selected @endif>{{$role['role_name']}}</option>
                    @endforeach
                </select>
                <label>Status</label>
                <select name="status_id" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status['id']}}" @if($user[0]['status_id'] == $status['id']) selected @endif>{{$status['name_status']}}</option>
                    @endforeach
                </select>
                <label>Birthday</label>
                <input type="date" name="birthday" value="{{$user[0]['birthday']}}" class="form-control"/>
                <label>Description</label>
                <input type="text" name="description" value="{{$user[0]['description']}}" class="form-control"/>
                <label>Date_interview</label>
                <input type="date" name="birthday" value="{{$user[0]['date_interview']}}" class="form-control"/>
                <label>Description_candidate</label>
                <input type="text" name="description" value="{{$user[0]['description_candidate']}}" class="form-control"/>
                <label>Start_work_date</label>
                <input type="date" name="start_work_date" value="{{$user[0]['start_work_date']}}" class="form-control"/>
                <label>Stop_work_date</label>
                <input type="date" name="stop_work_date" value="{{$user[0]['stop_work_date']}}" class="form-control"/>

                <label>Reason_for_dismissal</label>
                <input type="text" name="reason_for_dismissal" value="{{$user[0]['description']}}" class="form-control"/>
            <input type="submit" value="save"/>
            </form>
        </div>

        <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
        Зарплата {{$user[0]['salary']}}
        </div>

        <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">

        </div>
    </div>
@stop