<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Pledge;
use App\Events\SingupPledge;

class MailingController extends Controller
{
    public function getIndex(){
        $view = view("mails.mailing");
        $view->singedup = implode(",",Pledge::where("status",'=',2)->pluck("email")->all());
        $view->notsingedup = implode(",",Pledge::whereNotIn("status",[2,3])->pluck("email")->all());

        return $view;
    }

    public function resendMail($pledge_id){
        $pledge = Pledge::find($pledge_id);

        event(new SingupPledge($pledge));

        return redirect()->back();
    }
}
