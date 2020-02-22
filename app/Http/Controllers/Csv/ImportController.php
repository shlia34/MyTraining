<?php

namespace App\Http\Controllers\Csv;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use SplFileObject;

class ImportController extends CsvBaseController
{
    public function __invoke(Request $request)
    {
        //todo 変数名は要検討
        $csv = $request->file('csv');
        $originalFileName = $csv->getClientOriginalName();
        $tmpFileName = $originalFileName."_".uniqid("_").self::FILE_EXTENSION;
        $csv->move(public_path()."/csv/tmp",$tmpFileName);
        $tmpPath = public_path()."/csv/tmp/".$tmpFileName;
        $modelName = strstr($originalFileName, '_', true);
        $modelClass = $this->getModelClass($modelName);

        setlocale(LC_ALL, 'ja_JP.UTF-8');
        file_put_contents($tmpPath, mb_convert_encoding(file_get_contents($tmpPath), self::APP_ENCODING, self::CSV_ENCODING));

        $file = new SplFileObject($tmpPath);
        $file->setFlags(SplFileObject::READ_CSV);

        $columns = [];
        foreach ($file as $line) {
            if($file->key() === 0){
                for($i=0; $i < count($line); $i++){
                    $columns[] = $line[$i];
                }
            }

            if($file->key() > 0 && !$file->eof()){
                $model = new $modelClass();
                for($i=0; $i < count($line); $i++){
                    if($columns[$i] === "user_id"){
                        $model->user_id = Auth::user()->user_id;
                    }else{
                        $column = $columns[$i];
                        $model->$column = $line[$i];
                    }

                }
                $model->save();
            }
        }
        return redirect("/csv/index");
    }

}