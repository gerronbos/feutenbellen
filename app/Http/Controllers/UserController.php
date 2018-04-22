<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Providers\UserServiceProvider;


class UserController extends Controller
{
    public function getIndex(){
        $view = view("users.index");
        $view->users = User::orderBy("name",'asc')->get();

        return $view;
    }

    public function getNew(){
        $view = view("users.new");
        $view->user = new User();

        return $view;
    }
    public function postNew(UserCreateRequest $request){
        $user = UserServiceProvider::create($request->toArray());

        return redirect()->route('users')->with(['msg' => 'Gebruiker aangemaakt',"msg_type" => "success"]);
    }
    public function getEdit($user){
        $view = view("users.edit");
        $view->user = User::find($user);

        return $view;
    }
    public function postEdit(UserEditRequest $request, $user){
        $user = UserServiceProvider::edit(User::find($user),$request->toArray());

        return redirect()->route('users')->with(['msg' => 'Gebruiker gewijzigd',"msg_type" => "success"]);
    }
}
