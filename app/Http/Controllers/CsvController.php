<?php

namespace App\Http\Controllers;

use App\Csv\Csv;
use Illuminate\Http\Request;

class CsvController extends Controller
{

    public function index()
    {
        return view('top.csv');
    }

    public function export($modelName)
    {
        $file = (new Csv)->exportFile($modelName);
        $fileName = $modelName."_".date('Ymd').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ];

        return \Response::make($file, 200, $headers);

    }

    public function import(Request $request)
    {
        (new Csv)->importFile($request);
        return redirect("/csv/index");
    }

}













