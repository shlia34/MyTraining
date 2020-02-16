<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SplFileObject;

class CsvController extends Controller
{

    public function downloadTable($modelName){

        $modelClass = "App\\".$modelName;

        $filename = $modelName."_".date('Ymd').".csv";

        $stream = fopen('php://temp', 'r+b');

        $output = array();
        $columnList = $modelClass::getCsvList();

        foreach($columnList as $column){
            $output[] = $column;
        }
        // CSVファイルを出力
        fputcsv($stream, $output);

        $items = $modelClass::all();

        foreach ($items as $items) {
            $output = array();
            foreach ($columnList as $column) {
                $output[] = str_replace(array("\r\n", "\r", "\n"), '', $items->$column);
            }
            // CSVファイルを出力
            fputcsv($stream, $output);
        }

        // ポインタの先頭へ
        rewind($stream);
        // 改行変換
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        // 文字コード変換
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
        // header
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        );

        return \Response::make($csv, 200, $headers);

    }

    //todo この二つの名前は変更する
    public function TrainingDownload(){
        return $this->downloadTable("Training");
    }

    public function EventDownload(){
        return $this->downloadTable("Event");
    }

    public function StageDownload(){
        return $this->downloadTable("Stage");
    }

    //todo ファイル名の頭でバリデーションする
    //todo 名前がしっこりきてない
    public function import(Request $request){

        $records = $this->read($request);
        $modelName = $this->getModelName($request);
        $modelClass = "App\\".$modelName;
        $columns = $modelClass::getCsvList();

        foreach ($records as $record){
            $model = new $modelClass();
            foreach ($columns as $column ){
                if ($column === 'user_id'){
                    $model->$column = Auth::user()->user_id;
                }else{
                    $model->$column = $record[$column];
                }
            }
            $model->save();
        }
        return redirect("/setting");
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
        file_put_contents($tmppath, mb_convert_encoding(file_get_contents($tmppath), 'UTF-8', 'SJIS'));

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