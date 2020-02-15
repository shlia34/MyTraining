<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileObject;

class CsvController extends Controller
{

    public function downloadTable($modelName){

        $filename = $modelName."_".date('Ymd').".csv";

        $stream = fopen('php://temp', 'r+b');

        $output = array();
        $columnList = $modelName::getCsvList();

        foreach($columnList as $column){
            $output[] = $column;
        }
        // CSVファイルを出力
        fputcsv($stream, $output);

        $items = $modelName::all();

        foreach ($items as $items) {
            $output = array();
            foreach ($columnList as $column) {
                if($column === 'stage_name'){
                    $output[] = str_replace(array("\r\n", "\r", "\n"), '', $items->getStageName() );
                }else{
                    $output[] = str_replace(array("\r\n", "\r", "\n"), '', $items->$column);
                }
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
        return $this->downloadTable("App\Training");
    }

    public function EventDownload(){
        return $this->downloadTable("App\Event");
    }

    public function importCsv($request){


        $originalName = $request->file('csv')->getClientOriginalName();

        $tmpname = $originalName."_".uniqid("_").'csv'; //TMPファイル名

        $csv = $request->file('csv');

        $csv->move(public_path()."/csv/tmp",$tmpname);
        $tmppath = public_path()."/csv/tmp/".$tmpname;

        setlocale(LC_ALL, 'ja_JP.UTF-8');
        file_put_contents($tmppath, mb_convert_encoding(file_get_contents($tmppath), 'UTF-8', 'SJIS'));

        try {
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

        } catch (Exception $e) {
            echo  $e->getMessage();
        }finally{
        }

        return null;
    }

    public function importEvent(Request $request){
        $record = $this->importCsv($request);
        dd($record);
    }



    public function importTraining(){}


}