<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clients extends Model
{
    protected $fillable = ['first_name','last_name','country','timezone','email','messanger','description_client','other_info','comm_status_id','trust_id','who_join_user_id','updated_at'];

    public static function getClients(){
        $clients = Clients::all();
        return $clients;
    }
    public static function getClientById($id){
        $client = Clients::findOrFail($id)->toArray();
        return $client;
    }
    public static function addClient($request){
        $create = Clients::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'country'=> $request->country,
            'timezone'=> $request->timezone,
            'email'=> $request->email,
            'messanger'=> $request->messanger,
            'description_client'=> $request->description_client,
            'other_info'=> $request->other_info,
            'comm_status_id'=> $request->comm_status_id,
            'trust_id'=> $request->trust_id,
            'who_join_user_id'=> $request->who_join_user_id
        ]);
        if($create){
            return $create->toArray();
        }else{
            return false;
        }

    }
    public static function updateClientById($id, $request){
        $update = Clients::find($id)->update(array(
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'country'=> $request->country,
            'timezone'=> $request->timezone,
            'email'=> $request->email,
            'messanger'=> $request->messanger,
            'description_client'=> $request->description_client,
            'other_info'=> $request->other_info,
            'comm_status_id'=> $request->comm_status_id,
            'trust_id'=> $request->trust_id,
            'who_join_user_id'=> $request->who_join_user_id,
            'updated_at'=> Carbon::now()
        ));

        if($update){
            return $update;
        }else{
            return false;
        }
    }
}
