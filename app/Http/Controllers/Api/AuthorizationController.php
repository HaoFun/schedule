<?php

namespace App\Http\Controllers\Api;

use App\Services\AuthorizationService;
use League\OAuth2\Server\Exception\OAuthServerException;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Requests\AuthorizationRequest as AuthRequest;

class AuthorizationController extends BaseApiController
{
    protected $service;

    const defaultFields = [
        'account', 'name', 'email', 'department_id', 'language', 'password'
    ];
    const deleteFields = ['status' => 0];

    public function __construct(AuthorizationService $service)
    {
        $this->service = $service;
    }

    public function signUp(AuthRequest $request)
    {
        $result = $this->service->create(array_only($request->all(), self::defaultFields));
        return $result ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.user')), 201) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.user')));
    }

    public function update(AuthRequest $request, $id)
    {
        $result = $this->service->modify(array_only($request->all(), self::defaultFields), $id);
        return $result ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.user'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.user'), $id));
    }

    public function me()
    {
        return $this->successWith(['user' => auth()->user()->toArray()]);
    }

    public function show($id)
    {
        $user = $this->service->find($id);
        return $user ?
            $this->successWith($user) :
            $this->error($this->makeMessage('common.not_found_id'), trans('transformer.user'), $id);
    }

    public function store(AuthorizationRequest $originRequest, AuthorizationServer $server, ServerRequestInterface $serverRequest)
    {
        try {
            return $server->respondToAccessTokenRequest($serverRequest, new Psr7Response())->withStatus(201);
        } catch (OAuthServerException $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function userDestroy($id)
    {
        $result = $this->service->modify(self::deleteFields, $id);
        return $result ?
            $this->success(false, 204) :
            $this->error($this->makeMessage('common.delete_error', trans('transformer.user'), $id));
    }

    public function refresh(AuthorizationRequest $originRequest, AuthorizationServer $server, ServerRequestInterface $serverRequest)
    {
        try {
            return $server->respondToAccessTokenRequest($serverRequest, new Psr7Response())->withStatus(200);
        } catch (OAuthServerException $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function destroy()
    {
        auth()->user()->token()->revoke();
        return $this->success(false, 204);
    }
}
