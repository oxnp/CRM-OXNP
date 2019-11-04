@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@extends('layouts.header')
@section('content')


    <div class="top_panel">
        <div class="heading"><i class="fas fa-rocket"></i>
            Задача <span>{{$task['name']}}</span>
        </div>
    </div>


    <div class="divided row">
        <form class="col-md-8" action="{{route('tasks_update',[$project_id,$category_id,$task['id']])}}" method="POST">
            <div class="whbg">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head inp col-md-12">
                        Детали задачи
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Название</label>
                                </div>
                                <div class="col-md-7">
                                    <input readonly="readonly" type="text" name="name" value="{{$task['name']}}"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Спринт</label>
                                </div>
                                <div class="col-md-7">
                                    <select readonly="readonly" disabled="disabled" type="text" name="sprint_id">
                                        @foreach($sprints as $sprint)
                                            <option value="{{$sprint['id']}}"
                                                    @if($task['sprint_id'] == $sprint['id']) selected @endif>{{$sprint['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Назначил</label>
                                </div>
                                <div class="col-md-7">
                                    <select type="text" name="director_id" readonly="readonly" disabled="disabled">
                                        @foreach($users as $user)
                                            <option value="{{$user['id']}}"
                                                    @if($task['director_id'] == $user['id']) selected @endif>{{$user['name']}}
                                                - {{$user['role_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Назначена на</label>
                                </div>
                                <div class="col-md-7">
                                    <select type="text" name="executor_id" readonly="readonly" disabled="disabled">
                                        @foreach($users_by_project as $user)
                                            <option value="{{$user['id']}}"
                                                    @if($task['executor_id'] == $user['id']) selected @endif >{{$user['name']}}
                                                - {{$user['role_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Дата постановки</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD"
                                           name="date_start"
                                           readonly="readonly" value="{{$task['date_start']}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Дедлайн</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD"
                                           name="dead_line"
                                           readonly="readonly" value="{{$task['dead_line']}}"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Статус</label>
                                </div>
                                <div class="col-md-7">
                                    <select type="text" name="status_id" readonly="readonly" disabled="disabled">
                                        @foreach($tasks_statuses as $status)
                                            <option value="{{$status['id']}}"
                                                    @if($task['status_id'] == $status['id']) selected @endif >{{$status['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Приоритет</label>
                                </div>
                                <div class="col-md-7">
                                    <select type="text" name="priority_id" readonly="readonly" disabled="disabled">
                                        @foreach($tasks_priority as $priority)
                                            <option value="{{$priority['id']}}"
                                                    @if($task['priority_id'] == $priority['id']) selected @endif >{{$priority['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Оценка</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="time_estimate" readonly="readonly"
                                           value="{{$task['time_estimate']}}"/>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-5">
                                    <label>Фактическое время</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="time_tracker" readonly="readonly"
                                           value="{{$task['time_tracker']}}"/>
                                    <input name="_method" type="hidden" value="PUT">
                                    {{csrf_field()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head inp col-md-12">
                        Описание
                    </div>
                    <div class="inp">
                        <div class="col-md-12">
                            <textarea readonly="readonly" name="description"
                                      value="{{$task['description']}}">{{$task['description']}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="whbg col-md-4">
            <div class="inner">
                <div class="inp_head inp col-md-12">
                    Трекинг времени
                </div>
                <div class="inp realtime">
                    <div class="col-md-7">
                        @if ($flag_track)
                            <span id="tracking_time">{{$sum_my_time_for_task}}</span>
                        @else
                            {{$sum_my_time_for_task}}
                        @endif
                    </div>
                    <div class="col-md-5 text-right">
                        @if ($flag_track)
                            <form method="POST" name="stop_tracker"
                                  action="{{route('stop_track',[$category_id,$task['id'],$schedule_track_id,'task'])}}">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="PUT">
                                <label for="submit"><i class="far fa-pause-circle"></i></label>
                                <input type="submit" id="submit" value="stop">
                            </form>
                        @else
                            <form method="POST" name="start_tracker"
                                  action="{{route('start_track',[$project_id,$task['id'],'task'])}}">
                                {{csrf_field()}}
                                <label for="submit"><i class="far fa-play-circle"></i></label>
                                <input type="submit" id="submit" value="start">
                            </form>
                        @endif
                    </div>
                </div>
                <div class="inp">
                    <div class="col-md-5">
                        <label>Оценка</label>
                    </div>
                    <div class="col-md-7 flexed">
                        <div class="gradline full"></div>
                        <span class="fulltime">{{$task['time_estimate']}}</span>
                        <?php $minutes = date('i', strtotime($task['time_estimate']));
                        $hours = date('h', strtotime($task['time_estimate']));
                        $h_to_min = $hours * 60;
                        $sum = $minutes + $h_to_min;
                        $perc = $sum / 100;?>
                    </div>
                </div>
                <div class="inp">
                    <div class="col-md-5">
                        <label>Осталось</label>
                    </div>
                    <div class="col-md-7 flexed">
                        <?php $datetime1 = date_create($task['time_estimate']);
                        $datetime2 = date_create($task['time_tracker']);
                        $lefted = date_diff($datetime1, $datetime2);
                        $leftmins = $lefted->h + $lefted->i;?>
                        <span class="hide leftperc"><?php echo $left_perc = round($leftmins / $perc);?></span>
                        <div class="gradline left"></div>
                        <div class="lefttime">
                            <span class="hours">{{$lefted->h}}:</span><span class="mins">{{$lefted->i}}:</span><span
                                    class="secs">{{$lefted->s}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divided row">
        <div class="whbg col-md-12">
            <div class="inner">
                <div class="col-md-12">
                    <div class="inp_head">
                        Вложения
                    </div>
                    <div class="attachments">
                        @foreach($task_attachments as $attach)
                            @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                                <a data-fancybox="gallery" href="{{$attach['storage']}}">
                                    <img src="{{$attach['storage']}}"/>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="attach_file">
                        <a class="show_attach"><i class="fas fa-plus"></i> Добавить вложение</a>
                        <form action="{{ route('tasks_attachment_by_id',[$project_id,$task['id']])}}" method="POST"
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







    <div class="col-md-4">
        all my time to task {{$sum_my_time_for_task}}

        @if ($flag_track)
            <form method="POST" name="stop_tracker"
                  action="{{route('stop_track',[$category_id,$task['id'],$schedule_track_id,'task'])}}">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" value="stop">
            </form>
        @else
            <form method="POST" name="start_tracker" action="{{route('start_track',[$project_id,$task['id'],'task'])}}">
                {{csrf_field()}}
                <input type="submit" value="start">
            </form>
        @endif


        <table>
            <thead>
            <th>Name</th>
            <th>Track time</th>
            <th>Action</th>
            </thead>
            @foreach($schedules as $schedule)
                <tr>
                    <td width="80px">{{$schedule['name']}}</td>
                    <td width="80px">@if($schedule['user_id'] == Auth::id() && $schedule['flag_in_progress_th'] == 1) {{$curr_track_for_task}} @else {{$schedule['total_time']}}@endif</td>
                    <td>@if($schedule['user_id'] == Auth::id() && $schedule['flag_in_progress_th'] == 1)
                        <!--<form  method = "POST"  name = "stop_tracker" action = "{{route('stop_track',[$category_id,$task['id'],$schedule['id'],'task'])}}">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="PUT">
                                <input type="submit" value="stop">
                            </form> -->

                        @endif</td>
                </tr>
            @endforeach
        </table>

    </div>
@stop