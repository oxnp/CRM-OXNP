@section('left-sidebar')

    {{$project['name']}}
    <!--
    <ul>
        @foreach($categories_to_project as $category)
            <li>{{$category['name']}}</li>
        @endforeach

    </ul>
    -->
    <ul>
    @foreach($tree_category_and_task as $name_category=>$data)
            <li>{{$name_category}} <a href="{{route('show_add_task_form',[$project['id'],array_key_first($data)])}}">+</a></li>
        @if(is_array($data))
        @foreach($data as $k=>$v)
                <!--id category:{{$k}} -->
                    @if(is_array($v) && !empty($v))
                        <ul>

                        @foreach($v as $kdata=>$vdata)

                            @if(isset($vdata['id']))
                                <li> <a href="{{route('tasks_show_detail',[$project['id'],$k,$vdata['id']])}}">{{$vdata['name']}}</a>
                                    <a href="{{route('show_add_sub_task_form',[$project['id'],$k,$vdata['id']])}}">+</a>
                                </li>
                                @endif
                            @if(isset($vdata['subtasks']))
                                <ul>
                                @foreach($vdata['subtasks'] as $subk=>$subv)
                                        <li><a href="{{route('subtasks_show_detail',[$project['id'],$k,$subv['id']])}}">{{$subv['name']}}</a></li>
                                @endforeach
                                </ul>
                            @endif
                        @endforeach
                        </ul>
                    @endif
        @endforeach

            @endif


    @endforeach
    </ul>
    Select category
@if($projects_categories)
    <form name="add-category-to-project" action="{{route('add_category_to_project',$project['id'])}}" method="POST">
        <select name="categoriestoproject" class="form-control">
            @foreach($projects_categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
            @endforeach
        </select>
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Add category"/>
    </form>
@endif
    New category
    <form name="add-category" action="{{route('add_category_to_project',$project['id'])}}" method="POST">
        <input type="text" name="categoriestoproject" class="form-control"/>
        {{csrf_field()}}
        <input type="submit" class="form-control btn btn-primary" value="Add category"/>
    </form>

@stop