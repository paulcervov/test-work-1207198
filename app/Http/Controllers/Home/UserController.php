<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StoreUserRequest;
use App\Http\Requests\Home\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::query()
            ->withTrashed()
            ->when(request('role'), function ($q, $role) {
                return $q->where('role_id', $role);
            })
            ->when(request('query'), function ($q, $query) {
                return $q->where('name', 'like', "%{$query}%");
            })
            ->when(request('column', 'updated_at'), function ($q, $column) {
                return $q->orderBy($column, request('direction', 'desc'));
            })
            ->paginate();

        $roles = Role::all();

        return view('home.users.index', [
            'users' => $users,
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
        $roles = Role::all();

        return view('home.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()
            ->route('home.users.index')
            ->with('status', __('messages.users.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('home.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('home.users.index')
            ->with('status', __('messages.users.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('home.users.index')
            ->with('status', __('messages.users.deleted'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()
            ->findOrFail($id);

        $user->restore();

        return redirect()
            ->route('home.users.index')
            ->with('status', __('messages.users.restored'));
    }
}
