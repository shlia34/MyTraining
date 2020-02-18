<?php

namespace App\Http\Controllers\Csv;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CsvBaseController extends Controller
{

    const MODEL_PREFIX = "App\\Models\\";
    const CSV_ENCODING = 'SJIS';
    const APP_ENCODING = 'UTF-8';
    const FILE_EXTENSION = '.csv';

    public function getColumns($modelName){
        $modelClass = $this->getModelClass($modelName);
        $tableName = (new $modelClass)->getTable();
        return Schema::getColumnListing($tableName);
    }

    public function getModelClass($modelName){
        return self::MODEL_PREFIX.$modelName;
    }
}