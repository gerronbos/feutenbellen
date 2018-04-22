<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Call as CallResource;
use App\Entities\Call;
use App\Http\Resources\UserResource;
use App\Entities\User;


class Pledge extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $call = Call::where("pledge_id",'=',$this->id)->first();
        $user = User::find($this->user_id);
        return [
            "id" => $this->id,
            "name" => $this->fullname,
            "dateofbirth" => $this->dateofbirth,
            "sex" => $this->sex,
            "addres" => $this->address,
            "age" => $this->age,
            "phone" => $this->usedPhoneNr,
            "emergency_phone" => $this->emergency_phone,
            "email" => $this->email,
            "education" => $this->education,
            "education_type" => $this->education_type,
            "shirt_size" => $this->shirtSizeLabel,
            "rabo_bicycle" => $this->rabo_bicycle,
            "diet" => $this->diet,
            "vegetarian" => $this->vegetarian,
            "pay_forward" => $this->pay_forward,
            "description" => $this->description,
            "status" => $this->statusLabel,
            "year" => $this->year,
            "calledBy" => ($call) ? new CallResource($call) : [],
            "by" => ($user) ? new UserResource($user) : []
        ];
    }
}
