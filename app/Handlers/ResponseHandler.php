<?php

namespace App\Handlers;

trait ResponseHandler
{
    public function success($message = false, $code = 200)
    {
        return $this->transformerResponse($message, $code);
    }

    public function successWith($data = [], $message = false, $code = 200)
    {
        return $this->transformerResponse($message, $code, $data);
    }

    public function error($message = false, $code = 404)
    {
        return $this->transformerResponse($message, $code);
    }

    public function errorWith($data = [], $message = false, $code = 404)
    {
        return $this->transformerResponse($message, $code, $data);
    }

    public function makeDefaultResponse($message = false)
    {
        $defaultResponse = [];
        return $message ? array_merge($defaultResponse, [
            'message' => $message
        ]) : $defaultResponse;
    }

    public function transformerResponse($message, $code, $data = [])
    {
        $response = $this->makeDefaultResponse($message);
        $response = count($data) ?
            array_merge($response, ['data' => $data]) :
            $response;
        return $this->respond($response, $code);
    }

    public function respond($data, $code, $header = [])
    {
        $header = array_merge($header, [
            'Content-Type' => 'application/json; charset=utf-8'
        ]);
        return response()->json($data, $code, $header, JSON_UNESCAPED_UNICODE);
    }

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