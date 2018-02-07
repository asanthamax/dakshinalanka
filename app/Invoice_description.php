<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_description extends Model
{
    //
    protected $fillable = ['description','quantity','amount'];
}
