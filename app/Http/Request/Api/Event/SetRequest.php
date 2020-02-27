<?php

namespace App\Http\Request\Api\Event;

class SetRequest extends IsoDateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|date',
            'end' => 'required|date',
        ];
    }

    protected function formatData()
    {
        $original = $this->validationData();
        $data['start'] = $this->formatIsoDate($original['start']);
        $data['end'] = $this->formatIsoDate($original['end']);

        $data =  $this->extendRange($data);

        return $data;
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
