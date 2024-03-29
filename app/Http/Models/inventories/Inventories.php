<?php

namespace App\Http\Models\inventories;

use Illuminate\Database\Eloquent\Model;
use DB;
class Inventories extends Model
{
    protected $fillable = ['name','category_id','sub_category_id','serial_number','who_used','user_id'];
    public $timestamps = false;
   public static function getInventories(){
       $list_inventories = Inventories::leftjoin('inventory_categories', function ($join){
           $join->on('inventory_categories.id','inventories.category_id');
           $join->orOn('inventory_categories.id','inventories.sub_category_id');
       })
           ->select('inventories.name as name',
               'inventories.id',
               'inventories.serial_number',
               'inventories.who_used',
               DB::raw('SUBSTRING_INDEX(group_concat(inventory_categories.name), \',\', 1) as cat_name'),
               DB::raw('SUBSTRING_INDEX(group_concat(inventory_categories.name), \',\', -1) as sub_cat_name'))
           ->groupby('inventories.id')->orderby('inventories.id','DESC')->get()->toArray();

       return $list_inventories;
   }

    public static function getInventoriesByUserId($id){
        $list_inventories = Inventories::leftjoin('inventory_categories', function ($join){
            $join->on('inventory_categories.id','inventories.category_id');
            $join->orOn('inventory_categories.id','inventories.sub_category_id');
        })
            ->select('inventories.name as name',
                'inventories.id',
                'inventories.serial_number',
                'inventories.who_used',
                DB::raw('SUBSTRING_INDEX(group_concat(inventory_categories.name), \',\', 1) as cat_name'),
                DB::raw('SUBSTRING_INDEX(group_concat(inventory_categories.name), \',\', -1) as sub_cat_name'))
            ->where('inventories.user_id',$id)
            ->groupby('inventories.id')->orderby('inventories.id','DESC')->get()->toArray();

        return $list_inventories;
    }

   public static function addInventory($request){

       $categories_part = explode(',',$request->categories);
       $user_data = explode(',',$request->who_used);
       $create = Inventories::create([
           'name'=>$request->name,
           'category_id'=>$categories_part[0],
           'sub_category_id'=>$categories_part[1],
           'serial_number'=>$request->serial_number,
           'who_used'=>$user_data[0],
           'user_id'=>$user_data[1],
           ]);

       if($create){
           return $create->toArray();
       }else{
           return false;
       }
   }

   public static function updateInventory($request, $id){
       $categories_part = explode(',',$request->categories);
       $user_data = explode(',',$request->who_used);
       $update = Inventories::find($id)->update(array(
           'name'=>$request->name,
           'category_id'=>$categories_part[0],
           'sub_category_id'=>$categories_part[1],
           'serial_number'=>$request->serial_number,
           'who_used'=>$user_data[0],
           'user_id'=>$user_data[1],
       ));
       if($update){
           return true;
       }else{
           return false;
       }
   }
}
