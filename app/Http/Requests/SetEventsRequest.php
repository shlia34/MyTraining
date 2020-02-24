<?php

namespace App\Http\Requests;

class SetEventsRequest extends FormatIsoDateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'date',
            'end' => 'date',
        ];
    }

    public function getFormattedDates(){
        return $this->formatDate();
    }

    /**
     * ISO形式の日付を「2020-01-01」のように整形
     * @param $date
     * @return mixed
     */
    protected function formatDate()
    {
        $original = $this->validationData();
        $dates['start'] = $this->formatIsoDate($original['start']);
        $dates['end'] = $this->formatIsoDate($original['end']);

        $dates =  $this->extendRange($dates);

        return $dates;

    }

    /**
     * startとendの日付をそれぞれ35日広げる
     * 前後の月に遷移したとき、すでに読み込まれてるeventとそうじゃないeventで若干ラグが出るのを防ぐ
     * @param $date
     * @return mixed
     */
    protected function extendRange($dates){
        $dates['start'] = date("Y-m-d",strtotime($dates['start'] . "-35 day"));
        $dates['end'] = date("Y-m-d",strtotime($dates['end'] . "+35 day"));
        return $dates;
    }


}
