<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dailyjob extends Model
{
    //
    protected $primaryKey = 'jobID';

    protected $fillable = ['customerID','material','thickness','date','duration','description'];

    public function customer(){

        $this->belongsTo('App\Customer');
    }
}
