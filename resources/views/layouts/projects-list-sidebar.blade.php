@section('left-sidebar')
 <ul>
  <li><a href="{{route('projects.index')}}"><i class="fas fa-project-diagram"></i>Projects</a></li>
  <li><a href="{{route('clients.index')}}"><i class="fas fa-user-tie"></i>Clients</a></li>
  <li><a href="{{route('inventories.index')}}"><i class="fas fa-warehouse"></i>Inventories</a></li>
  <li><a href="{{route('users.index')}}"><i class="fas fa-users"></i>Users</a></li>
 </ul>
@stop