<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Domain\Users\Models\User;
use App\Http\Controllers\Controller;
use Domain\Users\V1\Dtos\NewUserData;
use App\Http\Resources\V1\UserResource;
use Domain\Users\V1\Dtos\UpdateUserData;
use App\Http\Requests\User\V1\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use Domain\Users\V1\Actions\CreateNewUserAction;
use App\Http\Requests\User\V1\UpdateProfileRequest;
use Domain\Users\V1\Actions\UpdateProfileInfoAction;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', 'users');

        $users = User::query()
            ->with('roles')
            ->latest()
            ->paginate($request->input('perPage', 15));

        return UserResource::collection($users);
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

    public function update(UpdateProfileRequest $request, $id, UpdateProfileInfoAction $handler)
    {
        $this->authorize('edit', 'users');

        $user = User::find($id);

        $userData = UpdateUserData::fromRequest($request);

        $user = ($handler)($user, $userData);

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        $this->authorize('edit', 'users');

        User::destroy($id);

        return response()->noContent();
    }
}
