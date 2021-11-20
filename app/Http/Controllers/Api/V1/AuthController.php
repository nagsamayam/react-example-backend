<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Domain\Users\V1\Dtos\NewUserData;
use App\Http\Requests\User\V1\LoginRequest;
use App\Http\Requests\User\V1\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use Domain\Users\V1\Actions\CreateNewUserAction;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, CreateNewUserAction $handler)
    {
        $userData = NewUserData::fromRequest($request);

        $user = ($handler)($userData);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        /** @var User */
        $user = Auth::user();

        $token = $user->createToken($request->input('token_name', 'login_token'));

        return response([
            'jwt_token' => $token->plainTextToken,
        ]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
