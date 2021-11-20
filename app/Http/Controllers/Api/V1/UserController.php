<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\V1\RegisterRequest;
use Domain\Users\Models\User;
use Domain\Users\V1\Actions\CreateNewUserAction;
use Domain\Users\V1\Dtos\NewUserData;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::paginate();
    }

    public function store(RegisterRequest $request, CreateNewUserAction $handler)
    {
        $userData = NewUserData::fromRequest($request);

        $user = ($handler)($userData);

        return response($user, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response(User::find($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->noContent();
    }
}
