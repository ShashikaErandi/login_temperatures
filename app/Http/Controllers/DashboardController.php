<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($val = null){
        if($val == null){
            $user_temp = \App\Models\Temperature::where('user_id', \Auth::id())->get();
        }else{
            $user_temp = \App\Models\Temperature::where('user_id', \Auth::id())
            ->orderBy('city1_temperature', 'desc')
            ->orderBy('city2_temperature', 'desc')
            ->get();
        }
        return $user_temp;
    }
}
