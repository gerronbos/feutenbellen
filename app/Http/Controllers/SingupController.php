<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Pledge;
use View,Auth;
use App\Http\Requests\SingupRequest;
use App\Events\UpdatePledgeEvent;

class SingupController extends Controller
{
    public function getByUser(Request $request, $pledge){
        $view = View::make("calls.singup");
        $view->pledge = Pledge::find($pledge);
        $studies = Config("education.studies");
        $view->studies = array_sort($studies);
        $view->education_types = Config("education.types");
        $view->shirt_sizes = Config("shirtsize.size");

        return $view;
    }

    public function postByUser(SingupRequest $request, $pledge){
        $pledge = Pledge::find($pledge);
        $pledge->fill($request->toArray());
        $pledge->user_id = Auth::user()->id;
        $pledge->call_state = 0;
        $pledge->status = 2;
        $pledge->save();

        event(new UpdatePledgeEvent($pledge));
        event(new SingupPledge($pledge));

        return redirect()->route('calls')->with(["msg" => "Feut is ingeschreven!","msg_type" => "success"]);
    }

    public function getIndex(){
        $view = View::make("singup.index");
        $view->pledge = new Pledge(["sex" => "o"]);
        $studies = Config("education.studies");
        $view->studies = array_sort($studies);
        $view->education_types = Config("education.types");
        $view->shirt_sizes = Config("shirtsize.size");


        return $view;
    }
}
