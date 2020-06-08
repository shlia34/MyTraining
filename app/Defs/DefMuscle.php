<?php
namespace App\Defs;

/**
 * Class DefPart
 * @package App\Defs
 */
class DefMuscle {

    /**
     * 胸に関する定数
     */
    const MUNE_MUSCLE_CODE = "01";
    const MUNE_SHORT_MUSCLE_NAME = "胸";
    const MUNE_MUSCLE_NAME = "胸";
    const MUNE_MUSCLE_COLOR = "#d50000";

    /**
     * 背中に関する定数
     */
    const SENAKA_MUSCLE_CODE = "02";
    const SENAKA_SHORT_MUSCLE_NAME = "背";
    const SENAKA_MUSCLE_NAME = "背中";
    const SENAKA_MUSCLE_COLOR = "#104B2C";

    /**
     * 脚に関する定数
     */
    const ASHI_MUSCLE_CODE = "03";
    const ASHI_SHORT_MUSCLE_NAME = "脚";
    const ASHI_MUSCLE_NAME = "脚";
    const ASHI_MUSCLE_COLOR = "#3A337F";

    /**
     * 肩に関する定数
     */
    const KATA_MUSCLE_CODE = "04";
    const KATA_SHORT_MUSCLE_NAME = "肩";
    const KATA_MUSCLE_NAME = "肩";
    const KATA_MUSCLE_COLOR = "#ff4081";

    /**
     * 二頭筋に関する定数
     */
    const NITOU_MUSCLE_CODE = "05";
    const NITOU_SHORT_MUSCLE_NAME = "二";
    const NITOU_MUSCLE_NAME = "二頭筋";
    const NITOU_MUSCLE_COLOR = "#57B760";

    /**
     * 三頭筋に関する定数
     */
    const SANTOU_MUSCLE_CODE = "06";
    const SANTOU_SHORT_MUSCLE_NAME = "三";
    const SANTOU_MUSCLE_NAME = "三頭筋";
    const SANTOU_MUSCLE_COLOR = "#ef6c00";

    /**
     * 腹筋に関する定数
     */
    const HARA_MUSCLE_CODE = "07";
    const HARA_SHORT_MUSCLE_NAME = "腹";
    const HARA_MUSCLE_NAME = "腹筋";
    const HARA_MUSCLE_COLOR = "#454545";

    const MUSCLE_NAME_LIST = [
        self::MUNE_MUSCLE_CODE   =>self::MUNE_MUSCLE_NAME,
        self::SENAKA_MUSCLE_CODE =>self::SENAKA_MUSCLE_NAME,
        self::ASHI_MUSCLE_CODE   =>self::ASHI_MUSCLE_NAME,
        self::KATA_MUSCLE_CODE   =>self::KATA_MUSCLE_NAME,
        self::NITOU_MUSCLE_CODE  =>self::NITOU_MUSCLE_NAME,
        self::SANTOU_MUSCLE_CODE =>self::SANTOU_MUSCLE_NAME,
        self::HARA_MUSCLE_CODE   =>self::HARA_MUSCLE_NAME,
    ];

    const MUSCLE_SHORT_NAME_LIST = [
        self::MUNE_MUSCLE_CODE   =>self::MUNE_SHORT_MUSCLE_NAME,
        self::SENAKA_MUSCLE_CODE =>self::SENAKA_SHORT_MUSCLE_NAME,
        self::ASHI_MUSCLE_CODE   =>self::ASHI_SHORT_MUSCLE_NAME,
        self::KATA_MUSCLE_CODE   =>self::KATA_SHORT_MUSCLE_NAME,
        self::NITOU_MUSCLE_CODE  =>self::NITOU_SHORT_MUSCLE_NAME,
        self::SANTOU_MUSCLE_CODE =>self::SANTOU_SHORT_MUSCLE_NAME,
        self::HARA_MUSCLE_CODE   =>self::HARA_SHORT_MUSCLE_NAME,
    ];

    const MUSCLE_COLOR = [
        self::MUNE_MUSCLE_CODE   =>self::MUNE_MUSCLE_COLOR,
        self::SENAKA_MUSCLE_CODE =>self::SENAKA_MUSCLE_COLOR,
        self::ASHI_MUSCLE_CODE   =>self::ASHI_MUSCLE_COLOR,
        self::KATA_MUSCLE_CODE   =>self::KATA_MUSCLE_COLOR,
        self::NITOU_MUSCLE_CODE  =>self::NITOU_MUSCLE_COLOR,
        self::SANTOU_MUSCLE_CODE =>self::SANTOU_MUSCLE_COLOR,
        self::HARA_MUSCLE_CODE   =>self::HARA_MUSCLE_COLOR,
    ];
}
