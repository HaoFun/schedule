<?php

namespace App\Handlers;

trait MakeResponseTransHandler
{
    public function makeResponse($status, $message, $code = 200)
    {
        return [
            'status' => $status,
            'message' => $message,
            'code' => $code
        ];
    }

    public function makeMessage($trans, ...$attribute)
    {
        return sprintf(trans($trans), ...$attribute);
    }
}