<?php

namespace App\Http\Controllers\Api;

use App\Handlers\MakeResponseTransHandler;
use App\Handlers\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Services\AuthorizationService;
use League\OAuth2\Server\Exception\OAuthServerException;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Requests\AuthorizationRequest as AuthRequest;

class AuthorizationController extends Controller
{
    use ResponseHandler, MakeResponseTransHandler;

    protected $service;

    const createFields = [
        'account', 'name', 'email', 'department_id', 'language', 'password'
    ];

    public function __construct(AuthorizationService $service)
    {
        $this->service = $service;
    }

    public function signUp(AuthRequest $request)
    {
        $result = $this->service->create(array_only($request->all(), self::createFields));
        return $result ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.user'))) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.user')));
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
        return $this->success(trans('common.logout'), 204);
    }
}
