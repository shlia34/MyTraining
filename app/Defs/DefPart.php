<?php
namespace App\Defs;

/**
 * Class DefPart
 * @package App\Defs
 */
class DefPart {

    /**
     * 胸に関する定数
     */
    const MUNE_PART_CODE = "01";
    const MUNE_SHORT_PART_NAME = "胸";
    const MUNE_PART_NAME = "胸";
    const MUNE_PART_COLOR = "#d50000";

    /**
     * 背中に関する定数
     */
    const SENAKA_PART_CODE = "02";
    const SENAKA_SHORT_PART_NAME = "背";
    const SENAKA_PART_NAME = "背中";
    const SENAKA_PART_COLOR = "#104B2C";

    /**
     * 脚に関する定数
     */
    const ASHI_PART_CODE = "03";
    const ASHI_SHORT_PART_NAME = "脚";
    const ASHI_PART_NAME = "脚";
    const ASHI_PART_COLOR = "#3A337F";

    /**
     * 肩に関する定数
     */
    const KATA_PART_CODE = "04";
    const KATA_SHORT_PART_NAME = "肩";
    const KATA_PART_NAME = "肩";
    const KATA_PART_COLOR = "#ff4081";

    /**
     * 二頭筋に関する定数
     */
    const NITOU_PART_CODE = "05";
    const NITOU_SHORT_PART_NAME = "二";
    const NITOU_PART_NAME = "二頭筋";
    const NITOU_PART_COLOR = "#57B760";

    /**
     * 三頭筋に関する定数
     */
    const SANTOU_PART_CODE = "06";
    const SANTOU_SHORT_PART_NAME = "三";
    const SANTOU_PART_NAME = "三頭筋";
    const SANTOU_PART_COLOR = "#ef6c00";

    /**
     * 腹筋に関する定数
     */
    const HARA_PART_CODE = "07";
    const HARA_SHORT_PART_NAME = "腹";
    const HARA_PART_NAME = "腹筋";
    const HARA_PART_COLOR = "#454545";

    const PART_NAME_LIST = [
        self::MUNE_PART_CODE   =>self::MUNE_PART_NAME,
        self::SENAKA_PART_CODE =>self::SENAKA_PART_NAME,
        self::ASHI_PART_CODE   =>self::ASHI_PART_NAME,
        self::KATA_PART_CODE   =>self::KATA_PART_NAME,
        self::NITOU_PART_CODE  =>self::NITOU_PART_NAME,
        self::SANTOU_PART_CODE =>self::SANTOU_PART_NAME,
        self::HARA_PART_CODE   =>self::HARA_PART_NAME,
    ];

    const PART_SHORT_NAME_LIST = [
        self::MUNE_PART_CODE   =>self::MUNE_SHORT_PART_NAME,
        self::SENAKA_PART_CODE =>self::SENAKA_SHORT_PART_NAME,
        self::ASHI_PART_CODE   =>self::ASHI_SHORT_PART_NAME,
        self::KATA_PART_CODE   =>self::KATA_SHORT_PART_NAME,
        self::NITOU_PART_CODE  =>self::NITOU_SHORT_PART_NAME,
        self::SANTOU_PART_CODE =>self::SANTOU_SHORT_PART_NAME,
        self::HARA_PART_CODE   =>self::HARA_SHORT_PART_NAME,
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
