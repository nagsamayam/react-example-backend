<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Domain\Users\V1\Dtos\NewUserData;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\V1\UserResource;
use Domain\Users\V1\Dtos\UpdateUserData;
use App\Http\Requests\User\V1\LoginRequest;
use App\Http\Requests\User\V1\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use Domain\Users\V1\Actions\CreateNewUserAction;
use Domain\Users\V1\Actions\UpdatePasswordAction;
use App\Http\Requests\User\V1\UpdateProfileRequest;
use App\Http\Requests\User\V1\UpdatePasswordRequest;
use Domain\Users\V1\Actions\UpdateProfileInfoAction;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, CreateNewUserAction $handler)
    {
        $userData = NewUserData::fromRequest($request);

        $user = ($handler)($userData);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        /** @var User */
        $user = Auth::user();

        $token = $user->createToken($request->input('token_name', 'login_token'));

        $plainTextToken = $token->plainTextToken;

        $cookie = cookie('jwt_token', $plainTextToken, 60 * 24);

        return response([
            'jwt_token' => $plainTextToken,
        ])->withCookie($cookie);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt_token');

        return response()->noContent()->withCookie($cookie);
    }

    public function user(Request $request)
    {
        return response(new UserResource($request->user()));
    }

    public function updateInfo(UpdateProfileRequest $request, UpdateProfileInfoAction $handler)
    {
        $user = $request->user();

        $userData = UpdateUserData::fromRequest($request);

        $user = ($handler)($user, $userData);

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request, UpdatePasswordAction $handler)
    {
        $user = $request->user();

        $user = ($handler)($user, $request->input('password'));

        return response(['message' => 'Password updated',], Response::HTTP_ACCEPTED);
    }
}
