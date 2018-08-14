<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BaseException extends Exception
{
    public function report()
    {
        $this->saveLog();
        $response = $this->makeResponse();
        return response()->json($response);
    }

    protected function makeResponse()
    {
        return [
            'status' => $this->getCode() ?? 404,
            'data' => [
                'messages' => $this->getMessage()
            ]
        ];
    }

    protected function saveLog()
    {
        Log::channel('error_daily')->debug('Error Log Start ==========================');
        Log::channel('error_daily')->debug($this->getCode());
        Log::channel('error_daily')->debug($this->getMessage());
        Log::channel('error_daily')->debug('Error Log End ============================');
    }
}