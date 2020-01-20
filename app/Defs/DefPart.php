<?php
namespace App\Defs;

/**
 * Class DefPart
 * @package App\Defs
 */
class DefPart implements DefPartInterface {

    const PART_LIST = [
        self::MUNE_PART_CODE   =>self::MUNE_PART_NAME,
        self::SENAKA_PART_CODE =>self::SENAKA_PART_NAME,
        self::ASHI_PART_CODE   =>self::ASHI_PART_NAME,
        self::KATA_PART_CODE   =>self::KATA_PART_NAME,
        self::NITOU_PART_CODE  =>self::NITOU_PART_NAME,
        self::SANTOU_PART_CODE =>self::SANTOU_PART_NAME,
        self::HARA_PART_CODE   =>self::HARA_PART_NAME,
    ];

    const PART_COLOR = [
        self::MUNE_PART_CODE   =>self::MUNE_PART_COLOR,
        self::SENAKA_PART_CODE =>self::SENAKA_PART_COLOR,
        self::ASHI_PART_CODE   =>self::ASHI_PART_COLOR,
        self::KATA_PART_CODE   =>self::KATA_PART_COLOR,
        self::NITOU_PART_CODE  =>self::NITOU_PART_COLOR,
        self::SANTOU_PART_CODE =>self::SANTOU_PART_COLOR,
        self::HARA_PART_CODE   =>self::HARA_PART_COLOR,
    ];
}
