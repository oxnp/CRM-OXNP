<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;

class ClientsStatuses extends Model
{
    /*get client statuses
    * @param
    * @return array
    */
   public static function getClientsStatuses():array{
       $clients_statuses = ClientsStatuses::all()->toArray();
       return $clients_statuses;
    }
}
