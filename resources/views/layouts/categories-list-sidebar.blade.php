@section('left-sidebar')
    <div class="pr_name">
        {{$project['name']}}
    </div>
    <div class="sort">
        <input type="checkbox" id="sort"/>
        <label for="sort">Сортировать по спринтам <span><i class="fas fa-check"></i></span></label>
    </div>
    <ul class="project_menu transit">
        @foreach($tree_category_and_task as $name_category=>$data)
            <li class="list"><a href="#">{{$name_category}}</a>
            @if(is_array($data))
                @foreach($data as $k=>$v)
                    <!--id category:{{$k}} -->
                        @if(is_array($v) && !empty($v))
                            <ul class="items">
                                <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                                <a href="{{route('show_add_task_form',[$project['id'],array_key_first($data)])}}"><i
                                            class="fa fa-plus"></i> Add task</a>
                                <a href="{{route('show_add_bug_form',[$project['id'],$k])}}"><i class="fa fa-plus"></i>
                                    Add bug</a>
                                @if (isset($tree_category_and_task[$name_category][$k]['tasks']))
                                    <li class="list tasks"><a href="#">Tasks</a>
                                        <ul class="items">
                                            <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                                            @foreach($v as $kdata=>$vdata)
                                                @if($kdata == 'tasks' && isset($tree_category_and_task[$name_category][$k]['tasks']))
                                                    @foreach ($tree_category_and_task[$name_category][$k]['tasks'] as $key=>$task)
                                                        @if(isset($task['subtasks']))
                                                            <li class="list files">
                                                                <a href="{{route('tasks_show_detail',[$project['id'],$k,$task['id']])}}">{{$task['name']}}</a>
                                                                <span></span>
                                                                <ul class="items">
                                                                    <li>
                                                                        <a href="{{route('show_add_sub_task_form',[$project['id'],$k,$task['id']])}}"><i
                                                                                    class="fa fa-plus"></i> Add sub-task</a>
                                                                    </li>
                                                                    @foreach($task['subtasks'] as $subk=>$subv)
                                                                        <li>
                                                                            <a href="{{route('subtasks_show_detail',[$project['id'],$k,$subv['id']])}}">{{$subv['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @php unset($task['subtasks']) @endphp
                                                        @else
                                                            <li class="list files">
                                                                <a href="{{route('tasks_show_detail',[$project['id'],$k,$task['id']])}}">{{$task['name']}}</a>
                                                                <span></span>
                                                                <ul class="items">
                                                                    <li>
                                                                        <a href="{{route('show_add_sub_task_form',[$project['id'],$k,$task['id']])}}"><i
                                                                                    class="fa fa-plus"></i> Add sub-task</a>
                                                                    </li>
                                                                </ul>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        @endif
                                                        @php unset($tree_category_and_task[$name_category][$k]['tasks']) @endphp
                                                    @endforeach
                                        </ul>
                                @else

                                @endif
                                @if (isset($tree_category_and_task[$name_category][$k]['bugs']))
                                    <li class="list bugs"><a href="#">Bugs</a>
                                        <ul class="items">
                                            <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                                            @foreach($v as $kdata=>$vdata)
                                                @if($kdata == 'bugs' && isset($tree_category_and_task[$name_category][$k]['bugs']))
                                                    @foreach ($tree_category_and_task[$name_category][$k]['bugs'] as $bug)
                                                        <li class="list-bugs files"><a
                                                                    href="{{route('show_bug',[$project['id'],$k,$bug['id']])}}">{{$bug['name']}}</a>
                                                        </li>
                                                    @endforeach
                                                    @php unset($tree_category_and_task[$name_category][$k]['bugs']) @endphp
                                                @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endif
                            </ul>
        @endforeach
        @endif
        @endforeach
        <li class="list">
            <a href="#"><i class="fa fa-plus" aria-hidden="true"></i>Add category</a>
            <ul class="items">
                <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                <!--Select category
                @if($projects_categories)
                    <form name="add-category-to-project" action="{{route('add_category_to_project',$project['id'])}}"
                          method="POST">
                        <select name="categoriestoproject" class="form-control">
                            @foreach($projects_categories as $category)
                                <option value="{{$category['name']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                        {{csrf_field()}}
                        <input type="submit" class="form-control btn btn-primary" value="Add category"/>
                    </form>
                @endif
                New category-->
                <form name="add-category" action="{{route('add_category_to_project',$project['id'])}}" method="POST">
                    <input list="catlist" autocomplete="off" type="text" name="categoriestoproject" class="form-control"/>
                    <datalist id="catlist">
                        @foreach($projects_categories as $category)
                            <option>{{$category['name']}}</option>
                        @endforeach
                    </datalist>
                    {{csrf_field()}}
                    <input type="submit" class="form-control btn btn-primary" value="Add category"/>
                </form>
            </ul>
        </li>
    </ul>


    <ul class="sprint_menu transit">
        @foreach($tree_by_sprints as $name_sprint=>$sprint_category)
            <li class="list"><a href="#">{{$name_sprint}}</a>
                <ul class="items">
                    <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                    @foreach($sprint_category as $category_name=>$tasks_bugs)
                        <li class="list"><a href="#">{{$category_name}}</a>
                            <ul class="items">
                                <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                                @foreach($tasks_bugs as $k=>$v)
                                    <li class="list {{$k}}"><a href="#">{{$k}}</a>
                                        <ul class="items">
                                            <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                                            @foreach($tasks_bugs[$k] as $item)
                                                @if(isset($item['subtasks']))
                                                    <li class="list files"><a
                                                                href="{{route('tasks_show_detail',[$item['project_id'],$item['category_id'],$item['id']])}}">{{$item['name']}}</a>
                                                        <span></span>
                                                        <ul class="items">
                                                            @foreach($item['subtasks'] as $subtask)
                                                                <li>
                                                                    <a href="{{route('subtasks_show_detail',[$subtask['project_id'],$subtask['category_id'],$subtask['id']])}}">{{$subtask['name']}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @break
                                                @else
                                                    @if($k == 'tasks')
                                                        <li>
                                                            <a href="{{route('tasks_show_detail',[$item['project_id'],$item['category_id'],$item['id']])}}">{{$item['name']}}</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{route('show_bug',[$item['project_id'],$item['category_id'],$item['id']])}}">{{$item['name']}}</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

            </li>
        @endforeach
        <li class="item">
            <a href="#"><i class="fa fa-plus" aria-hidden="true"></i>Add sprint</a>
            <ul class="items">
                <a class="goback"><i class="fas fa-chevron-left"></i> Go back</a>
                <form name="add-sprint" action="{{route('sprints_add',$project['id'])}}" method="POST">
                    <label class="control-label">name</label>
                    <input type="text" name="name" class="form-control"/>
                    <label class="control-label">date_from</label>
                    <input type="date" name="date_from" class="form-control"/>
                    <label class="control-label">date_to</label>
                    <input type="date" name="date_to" class="form-control"/>

                    {{csrf_field()}}
                    <input type="submit" class="form-control btn btn-primary" value="Add Sprint"/>
                </form>
            </ul>
        </li>
    </ul>
@stop