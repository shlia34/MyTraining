<?php

namespace App\Http\Controllers;

use App\Defs\DefPart;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
    }

    //todo uuid生成をみ直す。衝突の可能性が高い？
    protected function generateId($prefix){
        $uuid = md5(uniqid());
        return $prefix . $uuid;
    }

}
