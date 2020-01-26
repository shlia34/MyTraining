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
        'S0107'=>'ケーブルクロスオーバー',
    ];

    const SENAKA_STAGE_LIST = [
        'S0201'=>'デッドリフト',
        'S0202'=>'懸垂',
        'S0203'=>'ラットプルダウンフロント',
        'S0204'=>'バックエクステンション',
        'S0205'=>'ローイング',
        'S0206'=>'ラットプルダウンバック',
        'S0207'=>'ワンハンドローイング',
        'S0208'=>'シーテッドローイング',
    ];

    const ASHI_STAGE_LIST = [
        'S0301'=>'スクワット',
        'S0302'=>'スミスマシンスクワット',
        'S0303'=>'腿前のマシン',
        'S0304'=>'腿後ろのマシン',
        'S0305'=>'ヒップアダクション',
        'S0306'=>'スタンディングカーフレイズ',
        'S0307'=>'スミスマシンワイドスクワット',
        'S0308'=>'ブラジリアンスクワット',
        'S0309'=>'マシンスクワット',
    ];

    const KATA_STAGE_LIST = [
        'S0401'=>'ダンベルショルダープレス',
        'S0402'=>'マシンショルダープレス',
        'S0403'=>'サイドレイズ',
        'S0404'=>'アップライトロウ',
        'S0405'=>'アーノルドプレス',
        'S0406'=>'インクラインサイドレイズ',
        'S0407'=>'マシンリアレイズ',
    ];

    const NITOU_STAGE_LIST = [
        'S0501'=>'バーベルカール',
        'S0502'=>'ワンハンド',
        'S0503'=>'ケーブルカール',
        'S0504'=>'インクラインダンベルカール',
    ];

    const SANTOU_STAGE_LIST = [
        'S0601'=>'プルダウン',
        'S0602'=>'ナロープレス',
        'S0603'=>'スカルクラッシャー',
    ];

    const HARA_STAGE_LIST = [
        'S0701'=>'ドラゴンフライ',
        'S0702'=>'クランチ',
        'S0703'=>'アブローラー',
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

    const STAGE_SHORT_NAME_LIST = [];
    //todo 主要のトレの略語をスマホ用に作る。ex)BP,DL,SQ,

}