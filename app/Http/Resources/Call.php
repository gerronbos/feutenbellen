<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Entities\User;
use App\Entities\Pledge;

class Call extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $calledBy = User::find($this->user_id);
        $pledge = Pledge::find($this->pledge_id);
        return [
            "id" => $this->id,
            "calledBy" => $calledBy->name,
            "name" => $pledge->fullname,
            "phone" => $pledge->usedPhoneNr,
        ];
    }
}
