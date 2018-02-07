<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/31/2018
 * Time: 12:56 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    protected $primaryKey = 'stockID';

    protected $fillable = ['sheet_thickness','sheet_type','6x4price','8x4price','1sqft_price','material','quantity'];
}