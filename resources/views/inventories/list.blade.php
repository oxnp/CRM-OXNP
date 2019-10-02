<table>
    <thead>
    <tr><th>Категория</th>
        <th>Подкатегория</th>
        <th>Название</th>
        <th>Серийный номер</th>
        <th>Где</th>
    </tr>
    </thead>
@foreach($inventories_list as $item)

        <tr>
            <form action="{{route('inventories.update',$item['id'])}}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                {{csrf_field()}}
            <td>{{$item['cat_name']}}</td>
            <td>
                <select name="categories">
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
            <td><input type="text" name="name" value="{{$item['name']}}"/></td>
            <td><input type="text" name="serial_number" value="{{$item['serial_number']}}"/></td>
            <td>
                <select name="who_used">
                    <option value="Склад">Склад</option>
                    @foreach($users as $user)
                        <option value="{{$user['name']}}"  @if($user['name'] == $item['who_used']) selected @endif>{{$user['name']}}</option>
                    @endforeach
                </select>
                <input type="submit" value="save">
            </td>

            </form>
        </tr>

@endforeach
    </table>
добавить инвентарь
<form action="{{route('inventories.store')}}" method="POST" name="add_inventory">
    {{csrf_field()}}
<input type="text" name="name"/>
<input type="text" name="serial_number"/>
    <select name="categories">
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
    <select name="who_used">
        <option value="Склад">Склад</option>
        @foreach($users as $user)
            <option value="{{$user['name']}}">{{$user['name']}}</option>
        @endforeach
    </select>
    <input type="submit" value="добавить" \>
</form>