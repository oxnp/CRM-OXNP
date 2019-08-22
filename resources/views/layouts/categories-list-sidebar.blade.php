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
        @if(is_array($data))
        @foreach($data as $k=>$v)
                <!--id category:{{$k}} -->
                    @if(is_array($v))
                        <ul>
                        @foreach($v as $kdata=>$vdata)
                                <li> <a href="{{route('tasks_show_detail',[$project['id'],$k,$vdata['id']])}}">{{$vdata['name']}}</a></li>
                            @if(isset($vdata['subtasks']))
                                @foreach($vdata['subtasks'] as $subk=>$subv)
                                        <a href="{{route('tasks_show_detail',[$project['id'],$k,$subv['id']])}}">{{$subv['name']}}</a> <br>
                                @endforeach
                            @endif
                        @endforeach
                        </ul>
                    @endif
        @endforeach

            @endif
            <li>{{$name_category}}</li>
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