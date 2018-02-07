<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $primaryKey='invoiceID';

    protected $fillable = ['date', 'customer'];
}
