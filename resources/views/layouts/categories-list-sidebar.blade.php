@section('left-sidebar')
    <ul>
        @foreach($projects_categories as $category)
            <li>{{$category['name']}}</li>
        @endforeach
    </ul>
@stop