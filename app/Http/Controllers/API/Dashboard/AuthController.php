<?php

namespace App\Http\Controllers\API\Dashboard;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Controllers\API\BaseAuthController;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends BaseAuthController
{
    protected string $guard = 'admins';

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admins')->attempt($credentials)) {
            return $this->responseUnprocessable('The email address or password you entered is incorrect');
        }

        return $this->respondWithToken($token);
    }

    function userTransformer(): JsonResource
    {
        $user = auth($this->guard)->user();

        return new AdminResource($user);
    }
}
