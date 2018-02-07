<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 12/29/2017
 * Time: 12:04 AM
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{

    public function show(){

        return view('auth.login');
    }

    public function logoutuser(){

        Auth::logout();
        return redirect()->to('/');
    }
}