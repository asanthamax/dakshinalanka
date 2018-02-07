<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $primaryKey = 'customerID';

    protected $fillable = [
        'customer_name', 'contact_no', 'customer_email','customer_address'
    ];

    public function jobs(){

        return $this->hasMany('App\Dailyjob','foreign_key','customerID');
    }
}
