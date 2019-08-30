@section('left-sidebar')
<ul>
@foreach($projects as $project)
        <li><a href="{{route('projects.show',$project['id'])}}">{{$project['name']}}</a></li>
@endforeach
 </ul>
@stop