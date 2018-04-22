<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Pledge;
use App\Events\SingupPledge;

class PledgeServiceProvider extends ServiceProvider
{
    public static function getPledge($options = []){
        $pledges = Pledge::where("id",'!=',0);

        if(isset($options["year"])){
            $pledges->where("year",'=',$options["year"]);
        }

        if(isset($options["withPhoneNr"])){
            $pledges->where(function($query){
                $query->whereNotNull("home_phone");
                $query->orWhereNotNull("mobile");
                $query->orWhereNotNull("phone_extra");
                $query->orWhereNotNull("emergency_phone");
            });
        }

        if(isset($options["status"])){
            if(is_numeric($options["status"])){
                $pledges->where("status",'=',$options["status"]);
            }
            elseif(is_array($options["status"])){
                $pledges->whereIn("status",$options["status"]);
            }

        }

        if(isset($options["sex"]) && $options["sex"]){
            $pledges->where("sex",'=',$options["sex"]);
        }
        if(isset($options["rabo_bicycle"])){

            $pledges->where("rabo_bicycle",'=',$options["rabo_bicycle"]);
        }

        if(isset($options["vegetarian"])){
            $pledges->where("vegetarian",'=',$options["vegetarian"]);
        }
        if(isset($options["pay_forward"])){
            $pledges->where("pay_forward",'=',$options["pay_forward"]);
        }

        return $pledges;
    }

    public static function getDups(){
        return self::getPledge(["year" => date("Y"),"status"=>[0,1,2,3,4,5]])->where("could_dup",'=',1);
    }

    public static function importUser($importdata,$fielddata,$customdata,$customdataFields){
        $pledge = new Pledge();
        foreach($fielddata as $key=>$value){
            if($value == "sex"){
                $pledge->$value = strtolower($importdata[$key]);
            }
            elseif($value == "living_place"){
                $pledge->$value = htmlentities(ucwords(strtolower($importdata[$key])), ENT_QUOTES, "UTF-8");
            }
            elseif($value == "dateofbirth"){
                $pledge->$value = date("Y-m-d",strtotime($importdata[$key]));
            }
            else{
                $pledge->$value = htmlentities($importdata[$key], ENT_QUOTES, "UTF-8");
            }
        }
        $own_input = $customdataFields;
        if(is_array($customdata)){
            foreach($customdata as $key=>$value){
                $pledge->$value = $own_input[$key];
            }
        }
        $pledge->save();
    }

    public static function createUser($data){
        $pledge = new Pledge();
        $pledge->fill($pledge);
        $pledge->status = $data["status"];
        $pledge->save();

        event(new SingupPledge($pledge));
    }

    public static function editUser(Pledge $pledge,$data){
        $pledge->fill($data);
        $pledge->status = $data["status"];
        $pledge->save();

        event(new SingupPledge($pledge));

        
    }
}
