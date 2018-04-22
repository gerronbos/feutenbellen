<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Call;
use App\Entities\Pledge;
use Auth;

class CallServiceProvider extends ServiceProvider
{
    public static function getCallList(){
        $pledges = Pledge::where("call_state",'=',1)->where("year",'=',date("Y"))->get();
        return $pledges;
    }
    
    public static function getNotCallList(){
        $pledges = Pledge::where("call_state",'=',0)->whereIn("status",[0,1,5])->where("year",'=',date("Y"))->take(50)->get();
        return $pledges;
    }

    public static function createCall($pledge){
        $call = new Call();
        $call->pledge_id = $pledge->id;
        $call->user_id = Auth::user()->id;
        $call->year = date("Y");
        $call->status = 1;
        $call->save();

        $pledge->call_state = 1;
        $pledge->save();

        return $call;
    }

    public static function saveCall($call,$data){
        $call->result = $data["result"];
        $call->description = $data["description"];
        $call->save();
    }
}
