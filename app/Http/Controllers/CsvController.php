<?php

namespace App\Http\Controllers;


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
        return $this->downloadTable("Training");
    }

    public function EventDownload(){
        return $this->downloadTable("Event");
    }

}