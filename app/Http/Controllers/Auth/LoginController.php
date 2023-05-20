<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Usecase\Auth\LoginUsecase;
use Exception;

class LoginController extends Controller
{
    /**
     * @param LoginUsecase $loginUsecase
     */
    public function __construct(
        private LoginUsecase $loginUsecase,
    ) {}

    /**
     * [POST] /api/login
     *
     * @param LoginRequest $request
     * @return UserResource
     */
    public function __invoke(LoginRequest $request): UserResource
    {
        try {
            $response = $this->loginUsecase->handle($request);
            return new UserResource($response);
        } catch (Exception $e) {
            // TODO: エラーをどう扱うか検討
        }
    }
}
