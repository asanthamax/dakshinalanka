<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit_payment extends Model
{
    //
    protected $primaryKey = 'recordID';

    protected $fillable = ['customer_id','amount_paid','outstanding_amount'];
}
