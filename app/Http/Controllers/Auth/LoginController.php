<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Usecase\Auth\LoginUsecase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

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
     * @return JsonResource
     */
    public function __invoke(LoginRequest $request): JsonResource
    {
        try {
            $response = $this->loginUsecase->handle($request);
            return new UserResource($response);
        } catch (Exception $e) {
            Log::debug($e);
            // TODO: エラーをどう扱うか検討
        }
    }
}
