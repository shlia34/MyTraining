<?php

namespace App\Http\Controllers\Csv;


class ExportController extends CsvBaseController
{

    public function __invoke($modelName)
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
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, self::CSV_ENCODING, self::APP_ENCODING);
        //ファイル名を決める
        $fileName = $modelName."_".date('Ymd').self::FILE_EXTENSION;

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ];

        return \Response::make($csv, 200, $headers);

    }



}