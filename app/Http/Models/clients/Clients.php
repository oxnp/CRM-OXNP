<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class Clients extends Model
{
    protected $fillable = ['first_name','last_name','country','timezone','email','messanger','description_client','other_info','comm_status_id','trust_id','who_join_user_id','manager_id','updated_at'];
    /*get clients
    * @param
    * @return array
    */
    public static function getClients():array{
      //  $clients = Clients::all()->toArray();
        $clients = Clients::
            leftjoin('users',function($join){
                $join->on('users.id','clients.who_join_user_id');
                $join->orOn('users.id','clients.manager_id');
            })
            ->leftjoin('clients_trust','clients_trust.id','clients.trust_id')
            ->leftjoin('clients_statuses','clients_statuses.id','clients.comm_status_id')
            ->select('clients.id',
                'clients.first_name as first_name',
                'clients.last_name as last_name',
                'clients.country',
                'clients.timezone',
                'clients_statuses.name as status',
                DB::raw('SUBSTRING_INDEX(group_concat(users.name), \',\', 1) as who_join'),
                DB::raw('SUBSTRING_INDEX(group_concat(users.name), \',\', -1) as manager')
            )
            ->groupby('clients.id')
            ->orderby('clients.country','asc')
            ->get()->toArray();
        return $clients;
    }
    /*get clients by ID
    * @param  int $id
    * @return array
    */
    public static function getClientById($id):array{
        $client = Clients::findOrFail($id)->toArray();

        return $client;
    }
    /*add client
    * @param  Request $request
    * @return array or false
    */
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
            'who_join_user_id'=> $request->who_join_user_id,
            'manager_id'=> $request->manager_id
        ]);
        if($create){
            return $create->toArray();
        }else{
            return false;
        }

    }
    /*update client
    * @param  int $id, Request $request
    * @return bool
    */
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
            'manager_id'=> $request->manager_id,
            'updated_at'=> Carbon::now()
        ));

        if($update){
            return true;
        }else{
            return false;
        }
    }
}
