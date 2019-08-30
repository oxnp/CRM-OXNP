<?php

namespace App\Http\Models\clients;

use Illuminate\Database\Eloquent\Model;

class ClientsTrust extends Model
{
    protected $table = 'clients_trust';
    /*get trust statuses*/
    public static function getTrustStatuses():array{
        $trust_statuses = ClientsTrust::all()->toArray();
        return $trust_statuses;
    }
}
