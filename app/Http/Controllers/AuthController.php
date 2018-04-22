<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View,Auth;
use App\Http\Requests\loginRequest;

class AuthController extends Controller
{
    public function getLogin(){
        return View::make("auth.login");
    }
    public function postLogin(loginRequest $request){
        if(Auth::attempt(['username' => $request->input("username"), 'password' => $request->input("password")],$request->input("remember"))){
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(["msg" => "Combinatie van wachtwoord en gebruikersnaam is niet correct"])->withInput();
    }

    public function getLogout(){
        Auth::logout();

        return redirect()->back();
    }
}
