@extends('layouts.default')
@extends('layouts.categories-list-sidebar')
@extends('layouts.header')
@section('content')

    <div class="top_panel">
        <div class="heading"><i class="fas fa-rocket"></i>
            Баг <span>{{$bug['name']}}</span>
        </div>
    </div>
    <form action="{{route('update_bug',[$project_id,$category_id,$bug['id']])}}" method="POST">
        <div class="divided row">
            <div class="whbg col-lg-8">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head inp col-md-12">
                        Детали задачи
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Описание</label>
                                    <textarea rows="3" name="description" value="{{$bug['description']}}"
                                              readonly="readonly">{{$bug['description']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Ожидаемый результат</label>
                                    <textarea rows="3" name="wait_result" value="{{$bug['wait_result']}}"
                                              readonly="readonly">{{$bug['wait_result']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Шаги</label>
                                    <textarea rows="10" name="steps" value="{{$bug['steps']}}"
                                              readonly="readonly">{{$bug['steps']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Фактический результат</label>
                                    <textarea rows="3" name="fact_result" value="{{$bug['fact_result']}}"
                                              readonly="readonly">{{$bug['fact_result']}}</textarea>
                                </div>
                            </div>
                            <div class="inp">
                                <div class="col-md-12">
                                    <label>Окружение</label>
                                    <textarea rows="3" name="arounds" value="{{$bug['arounds']}}"
                                              readonly="readonly">{{$bug['arounds']}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whbg col-lg-4">
                <div class="inner">
                    <a class="edit_fields"><i class="far fa-edit"></i></a>
                    <a class="loader"><i class="fas fa-spinner"></i></a>
                    <a class="save_fields"><i class="far fa-save"></i></a>
                    <div class="inp_head inp col-md-12">
                        Детали задачи
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Название:</label>
                        </div>
                        <div class="col-md-7">
                            <input name="name" value="{{$bug['name']}}" readonly="readonly"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Статус:</label>
                        </div>
                        <div class="col-md-7">
                            <select type="text" name="status_id" readonly="readonly" disabled="disabled">
                                @foreach($bugs_statuses as $status)
                                    <option value="{{$status['id']}}"
                                            @if($bug['status_id'] == $status['id']) selected @endif>{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Приоритет:</label>
                        </div>
                        <div class="col-md-7">
                            <select type="text" name="priority_id" readonly="readonly" disabled="disabled">
                                @foreach($bugs_priorities as $priority)
                                    <option value="{{$priority['id']}}"
                                            @if($bug['priority_id'] == $priority['id']) selected @endif>{{$priority['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Дедлайн:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" name="dead_line"
                                   readonly="readonly" value="{{$bug['dead_line']}}"/>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Спринт:</label>
                        </div>
                        <div class="col-md-7">
                            <select type="text" name="sprint_id" readonly="readonly" disabled="disabled">
                                @foreach($sprints as $sprint)
                                    <option value="{{$sprint['id']}}"
                                            @if($bug['sprint_id'] == $sprint['id']) selected @endif>{{$sprint['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Постановщик:</label>
                        </div>
                        <div class="col-md-7">
                            <select type="text" name="director_id" readonly="readonly" disabled="disabled">
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}"
                                            @if($bug['director_id'] == $user['id']) selected @endif >{{$user['name']}}
                                        - {{$user['role_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="inp">
                        <div class="col-md-5">
                            <label>Исполнитель:</label>
                        </div>
                        <div class="col-md-7">
                            <select type="text" name="executor_id" readonly="readonly" disabled="disabled">
                                @foreach($users_by_project as $user)
                                    <option value="{{$user['id']}}"
                                            @if($bug['executor_id'] == $user['id']) selected @endif >{{$user['name']}}
                                        - {{$user['role_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input name="_method" type="hidden" value="PUT">
        {{csrf_field()}}
    </form>

    <div class="divided row">
        <div class="whbg col-md-12">
            <div class="inner">
                <div class="col-md-12">
                    <div class="inp_head">
                        Вложения
                    </div>
                    <div class="attachments">
                        @foreach($bugs_attachments as $attach)
                            @if($attach['type_file'] == 'jpg' || $attach['type_file'] == 'png' || $attach['type_file'] == 'jpeg')
                                <a data-fancybox="gallery" href="{{$attach['storage']}}">
                                    <img src="{{$attach['storage']}}"/>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="attach_file">
                        <a class="show_attach"><i class="fas fa-plus"></i> Добавить вложение</a>
                        <form action="{{ route('bugs_attachment_by_id',[$project_id,$bug['id']])}}" method="POST"
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