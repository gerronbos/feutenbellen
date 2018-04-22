<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Providers\CallServiceProvider;
use App\Http\Resources\PledgeCollection;
use App\Entities\Pledge;
use App\Entities\Call;
use App\Events\CreateCall;

class CallController extends Controller
{
   public function getIndex(){
       $view = View::make("calls.index");

       return $view;
   }


   public function getShow(Request $request, $pledge){
        $pledge = Pledge::find($pledge);
        $view = View::make("calls.show");
        $view->pledge = $pledge;
        $view->calls = Call::where("pledge_id",'=',$pledge->id)->whereNotNull("result")->orderBy("created_at","desc")->get();
        if($request->input("call_id")){
            $view->current_call = Call::find($request->input("call_id"));
            $view->call_options = Config("status.call");
        }

        return $view;
   }

   public function postShow($pledge){
        $pledge = Pledge::find($pledge);
        $call = CallServiceProvider::createCall($pledge);

        event(new CreateCall());

        return redirect()->route('call.show', [$pledge->id,"call_id"=>$call->id]);
   }

   public function saveShow(Request $request, $pledge){
       $call = Call::find($request->input("call_id"));
       $pledge = Pledge::find($pledge);
        switch($request->input("save")){
            case "save":
                CallServiceProvider::saveCall($call,["result" => $request->input("result"), "description" => $request->input("description")]);
                $pledge->call_state = 0;
                if(in_array($request->input("result"),[4,8,9])){
                    $pledge->status = 3;
                }
                $pledge->save();
                event(new CreateCall());
                return redirect()->route('call.show', [$pledge->id]);
            break;
            case "singup":
                CallServiceProvider::saveCall($call,["result" => $request->input("result"), "description" => $request->input("description")]);
                event(new CreateCall());
                return redirect()->route('call.singup', [$pledge->id]);
            break;
            default:
                $call->delete();
                $pledge->call_state = 0;
                $pledge->save();
                event(new CreateCall());
                return redirect()->route('call.show', [$pledge->id]);
            break;
        }
        

   }

   public function getCalled(){
        return new PledgeCollection(CallServiceProvider::getCallList());
   }

   public function getNotCalled(){
    return new PledgeCollection(CallServiceProvider::getNotCallList());
   }
}
