<?php

namespace App\Defs;


/**
 * Interface DefPartInterface
 * @package App\Defs
 */
interface DefPartInterface
{
    //todo *_PART_SHORT_NAMEとかも作るかな

    /**
     * 胸に関する定数
     */
    const MUNE_PART_CODE = "01";
    const MUNE_PART_NAME = "胸 ";
    const MUNE_PART_COLOR = "#CC9933";

    /**
     * 背中に関する定数
     */
    const SENAKA_PART_CODE = "02";
    const SENAKA_PART_NAME = "背";
    const SENAKA_PART_COLOR = "#66CC00";

    /**
     * 脚に関する定数
     */
    const ASHI_PART_CODE = "03";
    const ASHI_PART_NAME = "脚";
    const ASHI_PART_COLOR = "#000033";

    /**
     * 肩に関する定数
     */
    const KATA_PART_CODE = "04";
    const KATA_PART_NAME = "肩";
    const KATA_PART_COLOR = "#FF6666";

    /**
     * 二頭筋に関する定数
     */
    const NITOU_PART_CODE = "05";
    const NITOU_PART_NAME = "二";
    const NITOU_PART_COLOR = "#CCCC00";

    /**
     * 三頭筋に関する定数
     */
    const SANTOU_PART_CODE = "06";
    const SANTOU_PART_NAME = "三";
    const SANTOU_PART_COLOR = "#FF5F17";

    /**
     * 腹筋に関する定数
     */
    const HARA_PART_CODE = "07";
    const HARA_PART_NAME = "腹";
    const HARA_PART_COLOR = "#808080";
}

