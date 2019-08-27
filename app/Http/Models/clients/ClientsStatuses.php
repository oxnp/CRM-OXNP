<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;

class ClientsStatuses extends Model
{
   public static function getClientsStatuses(){
       $clients_statuses = ClientsStatuses::all();
       return $clients_statuses;
    }
}
