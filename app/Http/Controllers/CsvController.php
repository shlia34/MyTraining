<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileObject;

class CsvController extends Controller
{

    const MODEL_PREFIX = "App\\Models\\";
    const CSV_ENCODING = 'SJIS';
    const APP_ENCODING = 'UTF-8';

    public function download($modelName){

        $modelClass = self::MODEL_PREFIX.$modelName;

        $filename = $modelName."_".date('Ymd').".csv";

        $stream = fopen('php://temp', 'r+b');

        $output = [];
        $columnList = $modelClass::getCsvList();


        foreach($columnList as $column){
            $output[] = $column;
        }

        // CSVファイルに出力
        fputcsv($stream, $output);

        $items = $modelClass::all();

        foreach ($items as $items) {
            $output = [];
            foreach ($columnList as $column) {
                $output[] = str_replace(array("\r\n", "\r", "\n"), '', $items->$column);
            }
            // CSVファイルに出力
            fputcsv($stream, $output);
        }

        // ポインタの先頭へ
        rewind($stream);
        // 改行変換
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        // 文字コード変換
        $csv = mb_convert_encoding($csv, self::CSV_ENCODING, self::APP_ENCODING);

        // header
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        );

        return \Response::make($csv, 200, $headers);

    }

    //todo ファイル名の頭でバリデーションする
    //todo 名前がしっこりきてない
    public function import(Request $request){

        $records = $this->read($request);
        $modelName = $this->getModelName($request);
        $modelClass = self::MODEL_PREFIX.$modelName;
        $columnList = $modelClass::getCsvList();

        foreach ($records as $record){
            $model = new $modelClass();
            foreach ($columnList as $column ){
                $model->$column = $record[$column];
            }
            $model->save();
        }
        return redirect("/admin");
    }

    public function getModelName($request){
        $originalName = $request->file('csv')->getClientOriginalName();
        return strstr($originalName, '_', true);
    }

    public function read($request){

        $csv = $request->file('csv');

        $originalName = $request->file('csv')->getClientOriginalName();
        $tmpname = $originalName."_".uniqid("_").'csv'; //TMPファイル名
        $csv->move(public_path()."/csv/tmp",$tmpname);
        $tmppath = public_path()."/csv/tmp/".$tmpname;

        setlocale(LC_ALL, 'ja_JP.UTF-8');
        file_put_contents($tmppath, mb_convert_encoding(file_get_contents($tmppath), self::APP_ENCODING, self::CSV_ENCODING));

        $file = new SplFileObject($tmppath);
        $file->setFlags(SplFileObject::READ_CSV);
        $records = [];
        $columnList = $file->fgetcsv();
        //一行目、すなわちカラム行を配列として取得

        foreach ($file as $line) {
            if($file->key() > 0 && !$file->eof()){
                $record = [];
                for($i=0; $i < count($line); $i++){
                    $record[ $columnList[$i] ] = $line[$i];
                }
                $records[] = $record;
            }
        }
        return $records;

    }


}