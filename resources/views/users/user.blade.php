@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')

    <div class="top_panel">

        <div class="pull-right">
            <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab"
                       aria-controls="home-md"
                       aria-selected="true">Карточка сотрудника</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab"
                       aria-controls="profile-md"
                       aria-selected="false">Другая инфа</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab"
                       aria-controls="contact-md"
                       aria-selected="false">Материалные ценности</a>
                </li>
            </ul>
        </div>
        <div class="heading"><i class="fas fa-user-circle"></i>Карточка сотрудника</div>
    </div>



    <div class="tab-content card pt-5" id="myTabContentMD">
        <div class="tab-pane fade active in" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
            <form action="{{route('users.update',$user[0]['user_id'])}}" method="POST" enctype="multipart/form-data">
                <div class="divided row">
                    <div class="whbg col-lg-4 col-md-6">
                        <div class="inner">
                            <a class="edit_fields"><i class="far fa-edit"></i></a>
                            <a class="loader"><i class="fas fa-spinner"></i></a>
                            <a class="save_fields"><i class="far fa-save"></i></a>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Фото:</label>
                                </div>
                                <div class="col-md-7">
                                    <img class="user_ava" src="{{$user[0]['avatar']}}">
                                    <input class="hide" type="file" name="avatar"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>ФИО:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="name" value="{{$user[0]['name']}}" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Должность:</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="role_id" readonly="readonly" disabled="disabled">
                                        @foreach($roles as $role)
                                            <option value="{{$role['role_id']}}"
                                                    @if($user[0]['role_id'] == $role['role_id']) selected @endif>{{$role['role_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Состояние:</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="status_id" readonly="readonly" disabled="disabled">
                                        @foreach($statuses as $status)
                                            <option value="{{$status['id']}}"
                                                    @if($user[0]['status_id'] == $status['id']) selected @endif>{{$status['name_status']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Дата рождения:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" name="birthday" value="{{$user[0]['birthday']}}"
                                           readonly="readonly"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="whbg col-lg-4 col-md-6">
                        <div class="inner">
                            <a class="edit_fields"><i class="far fa-edit"></i></a>
                            <a class="loader"><i class="fas fa-spinner"></i></a>
                            <a class="save_fields"><i class="far fa-save"></i></a>
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Описание сотрудника</label>
                                </div>
                                <div class="col-md-12">
                            <textarea rows="8" name="description" value="{{$user[0]['description']}}"
                                      readonly="readonly">{{$user[0]['description']}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="whbg col-lg-4 col-md-6">
                        <div class="inner">
                            <a class="edit_fields"><i class="far fa-edit"></i></a>
                            <a class="loader"><i class="fas fa-spinner"></i></a>
                            <a class="save_fields"><i class="far fa-save"></i></a>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Дата собеседования:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" name="date_interview" value="{{$user[0]['date_interview']}}"
                                           readonly="readonly"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Описание кандидата при собеседовании:</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea readonly="readonly" rows="5" name="description_candidate"
                                              value="{{$user[0]['description_candidate']}}">{{$user[0]['description_candidate']}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="whbg col-lg-4 col-md-6">
                        <div class="inner">
                            <a class="edit_fields"><i class="far fa-edit"></i></a>
                            <a class="loader"><i class="fas fa-spinner"></i></a>
                            <a class="save_fields"><i class="far fa-save"></i></a>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Начало работы:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" name="start_work_date" value="{{$user[0]['start_work_date']}}"
                                           readonly="readonly"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Дата увольнения:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" name="stop_work_date" value="{{$user[0]['stop_work_date']}}"
                                           readonly="readonly"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Причина увольнения:</label>
                                </div>
                                <div class="col-md-12">
                            <textarea rows="4" name="reason_for_dismissal" value="{{$user[0]['reason_for_dismissal']}}"
                                      readonly="readonly">{{$user[0]['reason_for_dismissal']}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="_method" type="hidden" value="PUT">
                {{csrf_field()}}
            </form>
        </div>
        <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
            <div class="divided row">
                <div class="whbg col-lg-4 col-md-6">
                    <div class="inner">
                        <div class="inp">
                            <div class="col-md-5">
                                <label>Зарплата</label>
                            </div>
                            <div class="col-md-7">
                                {{$user[0]['salary']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">

            <div class="t_content">
                <div class="thead">
                    <div class="col-md-3">Категория</div>
                    <div class="col-md-3">Подкатегория</div>
                    <div class="col-md-3">Название</div>
                    <div class="col-md-3">Серийный номер</div>
                </div>
                <div class="tbody">
                    @foreach($inventories as $item)
                        <div class="t_row">
                            <div class="col-md-3">
                                {{$item['cat_name']}}
                            </div>
                            <div class="col-md-3">
                                {{$item['sub_cat_name']}}
                            </div>
                            <div class="col-md-3">
                                {{$item['name']}}
                            </div>
                            <div class="col-md-3">
                                {{$item['serial_number']}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop