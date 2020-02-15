<?php

namespace App\Csv;

use SplFileObject;

Class Csv {

    public function getModelName($request){
        $originalName = $request->file('csv')->getClientOriginalName();
        return strstr($originalName, '_', true);

    }

    public function import($request){

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