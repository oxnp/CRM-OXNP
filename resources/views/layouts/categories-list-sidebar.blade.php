@section('left-sidebar')

    {{$project['name']}}
    <ul>
        @foreach($categories_to_project as $category)
            <li>{{$category['name']}}</li>
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