<?php
namespace App\Defs;

final class DefStage implements DefPartInterface {

    const MUNE_STAGE_LIST = [
        'S0101'=>'ベンチプレス',
        'S0102'=>'インクラインベンチプレス',
        'S0103'=>'チェストプレス',
        'S0104'=>'ダンベルフライ',
        'S0105'=>'インクラインダンベルフライ',
        'S0106'=>'マシンフライ',
        'S0107'=>'あの派手なやつ',
    ];

    const SENAKA_STAGE_LIST = [
        'S0201'=>'デッドリフト',
        'S0202'=>'懸垂',
        'S0203'=>'ラットプルダウン',
        'S0204'=>'ローイング',
    ];

    const ASHI_STAGE_LIST = [
        'S0301'=>'スクワット',
        'S0302'=>'マシンスクワット',
        'S0303'=>'腿前のマシン',
        'S0304'=>'腿後ろのマシン',
    ];

    const KATA_STAGE_LIST = [
        'S0401'=>'肩前',
        'S0402'=>'肩中',
        'S0403'=>'肩後',
    ];

    const NITOU_STAGE_LIST = [
        'S0501'=>'バーベルカール',
        'S0502'=>'ワンハンド',
        'S0503'=>'マシンカール',
    ];

    const SANTOU_STAGE_LIST = [
        'S0601'=>'プルダウン',
        'S0602'=>'ナロープレス',
        'S0603'=>'スカルクラッシャー',
    ];

    const HARA_STAGE_LIST = [
        'S0701'=>'クランチ',
        'S0702'=>'ドラゴンフライ',
    ];


    const STAGE_LIST = [
        self::MUNE_PART_CODE   => self::MUNE_STAGE_LIST,
        self::SENAKA_PART_CODE => self::SENAKA_STAGE_LIST,
        self::ASHI_PART_CODE   => self::ASHI_STAGE_LIST,
        self::KATA_PART_CODE   => self::KATA_STAGE_LIST,
        self::NITOU_PART_CODE  => self::NITOU_STAGE_LIST,
        self::SANTOU_PART_CODE => self::SANTOU_STAGE_LIST,
        self::HARA_PART_CODE   => self::HARA_STAGE_LIST,
    ];
}