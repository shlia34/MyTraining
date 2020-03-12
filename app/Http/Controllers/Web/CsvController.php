<?php

namespace App\Http\Controllers\Web;

use App\Csv\Csv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsvController extends Controller
{

    protected $csvClass;

    public function __construct()
    {
        $this->csvClass = new Csv();
        //todo controllerの中でnewしない
    }

    public function index()
    {
        return view('csv.index');
    }

    public function export($modelName)
    {
        $file = $this->csvClass->exportFile($modelName);
        $fileName = $modelName."_".date('Ymd').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ];

        return \Response::make($file, 200, $headers);
    }

    public function import(Request $request)
    {
        $this->csvClass->importFile($request);
        return redirect("/csv/index");
    }

}













