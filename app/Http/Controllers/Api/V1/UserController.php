<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\V1\RegisterRequest;
use App\Http\Requests\User\V1\UpdateProfileRequest;
use App\Http\Resources\V1\UserResource;
use Domain\Users\Models\User;
use Domain\Users\V1\Actions\CreateNewUserAction;
use Domain\Users\V1\Dtos\NewUserData;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', 'users');

        return UserResource::collection(User::with('roles')->paginate($request->input('perPage', 15)));
    }

    public function store(RegisterRequest $request, CreateNewUserAction $handler)
    {
        $this->authorize('edit', 'users');

        $userData = NewUserData::fromRequest($request);

        $user = ($handler)($userData);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $this->authorize('view', 'users');

        $user = User::with('roles')->find($id);

        return new UserResource($user);
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $this->authorize('edit', 'users');

        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        $this->authorize('edit', 'users');

        User::destroy($id);

        return response()->noContent();
    }
}
