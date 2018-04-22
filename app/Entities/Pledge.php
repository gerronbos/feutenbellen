<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $table = 'pledges';

    protected $fillable = ['initials', 'firstname', 'middlename', 'lastname', 'sex', 'living_place' ,'living_street', 'living_nr', 'living_extra', 'living_postcode', 'home_phone', 'mobile', 'phone_extra', 'emergency_phone', 'email', 'education', 'education_type', 'shirt_size', 'rabo_bicycle', 'diet', 'vegetarian', 'pay_forward', 'description', 'call_state', 'status', 'year'];

    public function user()
    {
        return $this->hasOne('App\Entities\User',"id","user_id");
    }
    
    public function getFullNameAttribute(){
        $name = $this->firstname." ";
        if($this->middlename){
            $name .= $this->middlename." ";
        }
        $name .= $this->lastname;

        return $name;
    }

    

    public function getUsedPhoneNrAttribute(){
        if($this->mobile){
            return $this->mobile;
        }
        elseif($this->home_phone){
            return $this->home_phone;
        }
        elseif($this->phone_extra){
            return $this->phone_extra;
        }
        elseif($this->emergencay_phone){
            return $this->emergencay_phone;
        }
        else{
            return "";
        }
    }
    
    public function getAddressAttribute(){
        return $this->living_street." ".$this->living_nr.$this->living_extra.", ".$this->living_postcode." ".$this->living_place;
    }

    public function getAgeAttribute(){
        $tz = new \DateTimeZone("Europe/Amsterdam");
        return \DateTime::createFromFormat("Y-m-d",$this->dateofbirth,$tz)->diff(new \DateTime('now',$tz))->y;
    }

    public function getStatusLabelAttribute(){
        $config = Config("status.pledge");


        return $config[$this->status];
    }

    public function getSexLabelAttribute(){
        if($this->sex == "m"){
            return "Man";
        }
        elseif($this->sex == "v"){
            return "Vrouw";
        }
        return "Onbekend";
        
    }

    public function getEducationTypeLabelAttribute(){
        if($this->education_type == "vt"){
            return "Voltijd";
        }
        return "Deeltijd";
    }

    public function getShirtSizeLabelAttribute(){
        switch ($this->shirt_size){
            case "xs":
                return "Extra small (XS)";
            break;
            case "s":
                return "Small (S)";
            break;
            case "m":
                return "Medium (M)";
            break;
            case "l":
                return "Large (L)";
            break;
            case "xl":
                return "Extra large (XL)";
            break;
            case "xxl":
                return "Extra Extra large (XXL)";
            break;
            default:
                return "Niet opgegeven";
            break;
            

        }
    }
}
