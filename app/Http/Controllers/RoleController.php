<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Requests\CreateRoleRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        return Inertia::render('Admin/Roles/RoleIndex', [
            'roles' => RoleResource::collection(Role::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : Response
    {
        return Inertia::render('Admin/Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create(['name' => $request->name]);

        return to_route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findById($id);

        return Inertia::render('Admin/Roles/Edit', [
           'role' => new RoleResource($role),
           'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRoleRequest $request, string $id)
    {
        $role = Role::findById($id);
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->input('permissions.*.name'));
        return to_route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);
        $role->delete();
        return back();
    }
}
