@section('left-sidebar')
 <ul class="list-group list-group-flush">
 <!--
@foreach($projects as $project)
        <li><a href="{{route('projects.show',$project['project_id'])}}">{{$project['project_name']}}</a></li>
@endforeach
 -->
  <li class="list-group-item"><a href="{{route('projects.index')}}">Projects</a></li>
  <li class="list-group-item"><a href="{{route('clients.index')}}">Clients</a></li>
  <li class="list-group-item"><a href="{{route('inventories.index')}}">Inventories</a></li>
  <li class="list-group-item"><a href="{{route('users.index')}}">Users</a></li>
 </ul>


@stop