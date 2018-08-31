<?php

namespace App\Http\Requests;

use App\Rules\CheckModelUnique;

class TrackerRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'trackers.store' :
            case 'trackers.update' : {
                return [
                    'tracker_name' => ['required', 'max:10',
                        new CheckModelUnique('tracker', 'tracker_name')],
                    'tracker_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
