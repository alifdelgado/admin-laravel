<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));
        $role->permissions()->attach($request->input('permissions'));
        return response(RoleResource::make($role->load('permissions')), Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        return RoleResource::make($role->load('permission'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->only('name'));
        $role->permissions()->sync($request->input('permissions'));
        return response(RoleResource::make($role), Response::HTTP_ACCEPTED);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
