<?php

namespace App\Handlers;

trait ResponseHandler
{
    protected $status = 'success';

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status = 'success')
    {
        $this->status = $status === 'success' ?
            $status : 'error';
    }

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
        $this->setStatus('error');
        return $this->transformerResponse($message, $code);
    }

    public function errorWith($data = [], $message = false, $code = 404)
    {
        $this->setStatus('error');
        return $this->transformerResponse($message, $code, $data);
    }

    public function makeDefaultResponse($message = false)
    {
        $defaultResponse = ['status' => $this->getStatus()];
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
}