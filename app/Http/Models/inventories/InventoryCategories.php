<?php

namespace App\Http\Models\inventories;

use Illuminate\Database\Eloquent\Model;

class InventoryCategories extends Model
{
    protected $fillable = ['name','main'];
    public $timestamps = false;
    public static function addCategory($request){
        $main_cat = InventoryCategories::where('name',$request->cat_name)->where('main',0)->get()->toArray();
        if (empty($main_cat)){
            $create_cat = InventoryCategories::create([
                'name'=> $request->cat_name,
                'main'=> 0
            ])->toArray();

            $create_sub_cat = InventoryCategories::create([
                'name'=> $request->sub_cat_name,
                'main'=> $create_cat['id']
            ]);
        }else{
            $create_sub_cat = InventoryCategories::create([
                'name'=> $request->sub_cat_name,
                'main'=> $main_cat[0]['id']
            ]);

        }
    }

    public static function getMainCategories(){
        $main_cat = InventoryCategories::where('main',0)->get()->toArray();
       return $main_cat;
    }

    public static function getSubCategories(){
        $sub_cats = InventoryCategories::where('main','!=',0)->get()->toArray();
        return $sub_cats;
    }

    public static function getCategoriesTree(){
        $main_cat = self::getMainCategories();
        $sub_cats = self::getSubCategories();
        $result = array();
        $tmp = array();

        foreach($main_cat as $cat){
            unset($tmp);
            foreach($sub_cats as $sub_cat) {
                if ($cat['id'] == $sub_cat['main']) {
                    $tmp[$cat['id'].','.$sub_cat['id']] = $sub_cat['name'];
                }
            }
            $result[$cat['id']]['name'] = $cat['name'];
            $result[$cat['id']]['sub_cats'] = $tmp;
        }
        return $result;
    }



}
