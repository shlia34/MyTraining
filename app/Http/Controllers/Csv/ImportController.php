<?php

namespace App\Http\Controllers\Csv;

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
        $columns = $this->getColumns($modelName);

        setlocale(LC_ALL, 'ja_JP.UTF-8');
        file_put_contents($tmpPath, mb_convert_encoding(file_get_contents($tmpPath), self::APP_ENCODING, self::CSV_ENCODING));

        $file = new SplFileObject($tmpPath);
        $file->setFlags(SplFileObject::READ_CSV);

        foreach ($file as $line) {
            if($file->key() > 0 && !$file->eof()){
                $model = new $modelClass();
                for($i=0; $i < count($line); $i++){
                    $column = $columns[$i];
                    $model->$column = $line[$i];
                }
                $model->save();
            }
        }
        return redirect("/admin");
    }

}