@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@extends('layouts.header')
@section('content')

    <div class="top_panel">
        <div class="heading"><i class="fas fa-poop"></i>
            {{$project['name']}} <span>{{$client['first_name']}} {{$client['last_name']}}, {{$client['country']}},({{$client['timezone']}})</span>
        </div>
    </div>


    <form action="{{route('projects.update',$project['id'])}}" name="project_update" method="POST">
        <div class="divided row">
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head inp col-md-12">
                        Описание проекта
                        <select class="inline" readonly="readonly" disabled="disabled" name="status_id">
                            @foreach($project_statuses as $status)
                                <option value="{{$status['id']}}"
                                        @if($status['id'] == $project['status_id']) selected @endif>{{$status['name_status']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Название</label>
                        </div>
                        <div class="col-md-7">
                            <input readonly="readonly" name="name" value="{{$project['name']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Старт:</label>
                        </div>
                        <div class="col-md-7">
                            <input readonly="readonly" name="date_start" value="{{$project['date_start']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Дедлайн:</label>
                        </div>
                        <div class="col-md-7">
                            <input readonly="readonly" name="date_end" value="{{$project['date_end']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Цена:</label>
                        </div>
                        <div class="col-md-7 hf">
                            <input disabled="disabled" type="radio" id="hval" value="Hourly"
                                   @if($project['price'] == 'Hourly') checked="checked" @endif name="price"/>
                            <label for="hval">Hourly</label>
                            <input disabled="disabled" type="radio" id="fval" value="Fixed"
                                   @if($project['price'] == 'Fixed') checked="checked" @endif name="price"/>
                            <label for="fval">Fixed</label>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-12">
                            <label>О проекте:</label>
                        </div>
                        <div class="col-md-12">
                            <textarea rows="8" readonly="readonly"
                                      name="description">{{$project['description']}}</textarea>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Текущий сайт:</label>
                        </div>
                        <div class="col-md-7">
                            <input readonly="readonly" name="curr_website" value="{{$project['curr_website']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Старый сайт:</label>
                        </div>
                        <div class="col-md-7">
                            <input readonly="readonly" name="old_website" value="{{$project['old_website']}}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <div class="inp_head col-md-12">
                        Контактные данные клиента
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Email:</label>
                        </div>
                        <div class="col-md-7">
                            {{$client['email']}}
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Messenger:</label>
                        </div>
                        <div class="col-md-7">
                            {{$client['messanger']}}
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-12">
                            <label>Другое:</label>
                        </div>
                        <div class="col-md-12">
                            <div class="txt_like">
                                {{$client['description_client']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-lg-4 col-md-6">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head col-md-12">
                        Описание проекта
                    </div>
                    <div class="inp">
                        <div class="col-md-12">
                            <textarea readonly="readonly" rows="19" name="accesses">{{$project['accesses']}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-md-6">
                <div class="inner">
                    <div class="inp_head col-md-4">
                        Позиция
                    </div>
                    <div class="inp_head col-md-4">
                        Пользователь
                    </div>
                    <div class="inp_head col-md-4">
                        Фактическое время
                    </div>
                    @foreach($total_time_for_project as $user_id => $user)
                        <div class="participant" data-attr="{{$user_id}}">
                            <div class="col-md-4">{{$user['role']}}</div>
                            <div class="col-md-4">{{$user['name']}}</div>
                            <div class="col-md-4">{{date('H часов i минут',strtotime($user['total_track_time']))}}</div>
                        </div>
                    @endforeach
                    <div class="attach_user col-md-12">
                        <a class="show_attach"><i class="fas fa-plus"></i> Добавить участника</a>
                        <div class="part_select">
                            <select name="participants_id[]" multiple class="form-control">
                                @php $participants = explode(',',$project['participants_id']); @endphp
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}"
                                            @if(in_array($user['id'],$participants)) selected @endif>{{$user['name']}}
                                        - {{$user['role_name']}}</option>
                                @endforeach
                            </select>
                            <input name="_method" type="hidden" value="PUT">
                            {{csrf_field()}}
                            <input type="submit" class="form-control btn btn-primary" value="Save"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-md-6">
                <div class="inner">
                    <div class="inp_head col-md-12">
                        Диаграмма Ганта
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="divided row">
        <div class="whbg col-md-12">
            <div class="inner">
                <div class="col-md-12">
                    <div class="inp_head">
                        Вложения
                    </div>
                    <div class="attachments">
                        @foreach($project_attachments as $attach)
                            @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                                <a data-fancybox="gallery" href="{{$attach['storage']}}">
                                    <img src="{{$attach['storage']}}"/>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="attach_file">
                        <a class="show_attach"><i class="fas fa-plus"></i> Добавить вложение</a>
                        <form action="{{ route('projects_attachment_by_id',$project['id'])}}" method="POST"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="files[]" multiple/>
                            <input type="submit" value="Upload"/>
                            @if($result_action['files_added'])
                                Upload {{$result_action['files_added']}} files
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop