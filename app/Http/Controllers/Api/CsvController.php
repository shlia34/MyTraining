<?php

namespace App\Http\Controllers\Api;

use App\Csv\Csv;
use App\Http\Controllers\Controller;

class CsvController extends Controller
{

    protected $csvClass;

    public function __construct()
    {
        $this->csvClass = new Csv();
    }

    public function index()
    {
        return response()->json($this->csvClass->modelNames);
    }

}

