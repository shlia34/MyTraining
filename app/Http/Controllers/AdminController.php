<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function setting(){
        return view('top.setting');
    }

    public function admin(){
        return view('top.admin');
    }


}













