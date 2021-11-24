<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use Domain\Users\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('view', 'roles');

        $roles = Role::with('permissions')->latest()->paginate();

        return RoleResource::collection($roles);
    }

    public function store(Request $request)
    {
        $this->authorize('edit', 'roles');

        try {
            $role = DB::transaction(function () use ($request) {
                $role = Role::create($request->only('name'));

                $role->permissions()->attach($request->input('permissions'));

                return $role->load('permissions');
            });
            return response(new RoleResource($role), Response::HTTP_CREATED);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'message' => 'Some thing went wrong',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists) {
            return response([
                'message' => 'Role already exists',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show($id)
    {
        $this->authorize('view', 'roles');

        $role = Role::find($id);

        return new RoleResource($role->load('permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit', 'roles');

        $role = Role::find($id);

        DB::transaction(function () use ($role, $request) {
            $role->update($request->only('name'));

            $role->permissions()->sync($request->input('permissions'));
            return $role;
        });

        return response(new RoleResource($role->load('permissions')), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        $this->authorize('edit', 'roles');

        Role::destroy($id);

        return response()->noContent();
    }
}
