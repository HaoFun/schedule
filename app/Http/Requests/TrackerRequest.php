<?php

namespace App\Http\Requests;

class TrackerRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'trackers.store' :
            case 'trackers.update' : {
                return [
                    'tracker_name' => 'required|max:10',
                    'tracker_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
