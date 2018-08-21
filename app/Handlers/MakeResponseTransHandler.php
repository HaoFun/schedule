<?php

namespace App\Handlers;

trait MakeResponseTransHandler
{
    public function makeResponse($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    public function makeMessage($trans, ...$attribute)
    {
        return sprintf(trans($trans), ...$attribute);
    }
}