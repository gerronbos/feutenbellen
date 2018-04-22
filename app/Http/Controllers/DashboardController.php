<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Pledge;
use App\Providers\PledgeServiceProvider;

class DashboardController extends Controller
{
    public function getIndex(){
        $view = view('dashboard.index');
        
        

        return $view;
    }
}
