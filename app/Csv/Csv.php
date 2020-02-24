<?php

namespace App\Csv;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use SplFileObject;

class Csv
{

    const MODEL_PREFIX = "App\\Models\\";
    const CSV_ENCODING = 'SJIS';
    const APP_ENCODING = 'UTF-8';

    public function exportFile($modelName)
    {
        $modelClass = $this->getModelClass($modelName);
        //ファイル 開く
        $stream = fopen('php://temp', 'r+b');
        //カラム出力
        $columns = $this->getColumns($modelName);
        fputcsv($stream, $columns);
        //出力はここを変更する
        $models = $modelClass::all();
        //modelを一行ずつ出力
        foreach ($models as $model) {
            $line =  array_values($model->toArray());
            fputcsv($stream, $line);
        }
        // ポインタの先頭へ
        rewind($stream);
        // 改行変換
        $file = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $file = mb_convert_encoding($file, self::CSV_ENCODING, self::APP_ENCODING);

        return $file;

    }

    public function getModelClass($modelName){
        return self::MODEL_PREFIX.$modelName;
    }

    public function getColumns($modelName){
        $modelClass = $this->getModelClass($modelName);
        $tableName = (new $modelClass)->getTable();
        return Schema::getColumnListing($tableName);
    }

    public function importFile($request)
    {
        //todo 変数名は要検討
        $csv = $request->file('csv');
        $originalFileName = $csv->getClientOriginalName();
        $tmpFileName = $originalFileName."_".uniqid("_").'.csv';
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
    }
}