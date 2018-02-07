<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 12/29/2017
 * Time: 2:10 AM
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


class AddUserController extends Controller
{

    public function index(){

        return view('auth.register');
    }

}