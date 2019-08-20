<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;

class ClientsTrust extends Model
{
    protected $table = 'clients_trust';
    public static function getTrustStatuses(){
        $trust_statuses = ClientsTrust::all();
        return $trust_statuses;
    }
}
