<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clients extends Model
{
    protected $fillable = ['first_name','last_name','country','timezone','email','messanger','description_client','other_info','comm_status_id','trust_id','who_join_user_id','updated_at'];
    /*get clients*/
    public static function getClients():array{
        $clients = Clients::all()->toArray();
        return $clients;
    }
    /*get clients by ID*/
    public static function getClientById($id):array{
        $client = Clients::findOrFail($id)->toArray();
        return $client;
    }
    /*add client*/
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
    /*update client*/
    public static function updateClientById($id, $request):bool{
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
            return true;
        }else{
            return false;
        }
    }
}
