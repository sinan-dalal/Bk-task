<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseAuthController extends Controller
{
    protected string $guard;

    public function __construct()
    {
        $this->middleware('auth:' . $this->guard, ['except' => ['login']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth($this->guard)->attempt($credentials)) {
            return $this->responseUnprocessable('The email address or password you entered is incorrect');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return $this->responseSuccess('logged user Token', [
            'token' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth($this->guard)->factory()->getTTL() * 60,
            ],
            'user' => $this->userTransformer(),
        ]);
    }

    function userTransformer(): JsonResource
    {
        $user = auth($this->guard)->user();

        return new UserResource($user);
    }
}
