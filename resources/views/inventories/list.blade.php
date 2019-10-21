@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@extends('layouts.header')
@section('content')
<table>
    <thead>
    <tr><th>Категория</th>
        <th>Подкатегория</th>
        <th>Название</th>
        <th>Серийный номер</th>
        <th>Где</th>
        <th></th>
    </tr>
    </thead>
@foreach($inventories_list as $item)

        <tr>
            <form action="{{route('inventories.update',$item['id'])}}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                {{csrf_field()}}
            <td>{{$item['cat_name']}}</td>
            <td>
                <select name="categories" class="form-control">
                    @foreach($inventory_categories as $id_main_cat=>$items)
                        <optgroup label="{{$items['name']}}">
                            @if(is_array($items['sub_cats']))
                                @foreach($items['sub_cats'] as $id_sub_cat=>$sub_cat)
                                    <option value="{{$id_sub_cat}}" @if($sub_cat == $item['sub_cat_name']) selected @endif>{{$sub_cat}}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="name" value="{{$item['name']}}" class="form-control"/></td>
            <td><input type="text" name="serial_number" value="{{$item['serial_number']}}" class="form-control"/></td>
            <td>
                <select name="who_used" class="form-control">
                    <optgroup label="Другое">
                        <option value="Общее пользование,0" @if('Общее пользование' == $item['who_used']) selected @endif>Общее пользование</option>
                        <option value="Склад,0" @if('Склад' == $item['who_used']) selected @endif>Склад</option>
                    </optgroup>
                    <optgroup label="Сотрудники">
                    @foreach($users as $user)
                        <option value="{{$user['name']}},{{$user['id']}}"  @if($user['name'] == $item['who_used']) selected @endif>{{$user['name']}}</option>
                    @endforeach
                    </optgroup>
                </select>

            </td>
                <td>
                <input type="submit" value="save" class="btn btn-primary">
                </td>
            </form>
        </tr>

@endforeach
    </table>
--------------------------------------------------------------------------------<br>
Добавить инвентарь
<table>
    <thead>
    <tr>
        <th>Категория</th>
        <th>Название</th>
        <th>Серийный номер</th>
        <th>Где</th>
        <th></th>
    </tr>
    </thead>
    <tr>
<form action="{{route('inventories.store')}}" method="POST" name="add_inventory">
    {{csrf_field()}}
    <td><select name="categories" class="form-control">
            @foreach($inventory_categories as $id_main_cat=>$item)
                <optgroup label="{{$item['name']}}">
                    @if(is_array($item['sub_cats']))
                        @foreach($item['sub_cats'] as $id_sub_cat=>$sub_cat)
                            <option value="{{$id_sub_cat}}">{{$sub_cat}}</option>
                        @endforeach
                    @endif
                </optgroup>
            @endforeach
        </select>
    </td>
    <td><input type="text" name="name" class="form-control"/></td>
    <td><input type="text" name="serial_number" class="form-control"/></td>

        <td>
            <select name="who_used" class="form-control">
                <optgroup label="Другое">
            <option value="Общее пользование,0">Общее пользование</option>
            <option value="Склад,0">Склад</option>
                </optgroup>
                <optgroup label="Сотрудники">
                @foreach($users as $user)
                    <option value="{{$user['name']}},{{$user['id']}}">{{$user['name']}}</option>
                @endforeach
                </optgroup>
            </select>

        </td>
    <td><input type="submit" value="добавить" \></td>
    </form>
    </tr>
</table>
--------------------------------------------------------------------------------<br>
Добавить категорию
<table>
    <thead>
    <tr>
        <th>Категория</th>
        <th>Подкатегория</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tr>
<form action="{{route('inventorycategories.store')}}" method="POST" name="add_category">
    {{csrf_field()}}
    <td><input type="text" name="cat_name" class="form-control" required/></td>
    <td><input type="text" name="sub_cat_name" class="form-control" required/></td>
    <td><input type="submit" value="добавить" class="form-control" \></td>
</form>
</tr>
</table>
@stop