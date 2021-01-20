<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StoreRoleRequest;
use App\Http\Requests\Home\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::query()
            ->withTrashed()
            ->when(request('query'), function ($q, $query) {
                return $q->where('name', 'like', "%{$query}%");
            })
            ->when(request('column', 'updated_at'), function ($q, $column) {
                return $q->orderBy($column, request('direction', 'desc'));
            })
            ->paginate();

        return view('home.roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('home.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        Role::create($validated);

        return redirect()
            ->route('home.roles.index')
            ->with('status', __('messages.roles.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        return view('home.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->update($validated);

        return redirect()
            ->route('home.roles.index')
            ->with('status', __('messages.roles.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
