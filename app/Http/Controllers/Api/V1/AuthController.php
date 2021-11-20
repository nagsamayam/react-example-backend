<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\V1\RegisterRequest;
use Domain\Users\V1\Actions\CreateNewUserAction;
use Domain\Users\V1\Dtos\NewUserData;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, CreateNewUserAction $handler)
    {
        $userData = NewUserData::fromRequest($request);

        $user = ($handler)($userData);

        return response($user, Response::HTTP_CREATED);
    }
}
