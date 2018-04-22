<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $table = 'calls';

    protected $fillable = ['feut_id', 'description', 'result', 'year'];

    public function user()
    {
        return $this->hasOne('App\Entities\User',"id","user_id");
    }
    public function pledge()
    {
        return $this->hasOne('App\Entities\Pledge',"id","pledge_id");
    }
}
