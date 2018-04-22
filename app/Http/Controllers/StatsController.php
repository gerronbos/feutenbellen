<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function getIndex(){
        $view = view("stats.index");

        return $view;
    }
}
