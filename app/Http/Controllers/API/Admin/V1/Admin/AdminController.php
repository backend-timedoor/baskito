<?php

namespace App\Http\Controllers\API\Admin\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\V1\Admin\StoreRequest;
use App\Http\Requests\API\Admin\V1\Admin\UpdateRequest;
use App\Http\Resources\API\Admin\V1\Admin\DetailAdminResource;
use App\Http\Resources\API\Admin\V1\Admin\ListAdminResource;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view.user')->only(['index', 'show']);
        $this->middleware('permission:edit.user')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $admins = User::query()->with('roles')->latest('id')->paginate(10);

        return ListAdminResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): DetailAdminResource
    {
        $role  = Role::whereSlug($request->input('role'))->firstOrFail();
        $admin = new User($request->only(['name', 'email', 'password']));

        $admin->saveOrFail();
        $admin->attachRole($role);

        return DetailAdminResource::make($admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin): DetailAdminResource
    {
        return DetailAdminResource::make($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $admin): DetailAdminResource
    {
        abort_if(auth_user()->is($admin), 403, 'You cannot edit your own profile in here.');
        abort_if($admin->isDeveloper(), 403, 'You cannot edit the developer profile.');

        $admin = DB::transaction(function () use ($admin, $request) {
            $role = Role::whereSlug($request->input('role'))->get();

            if ($request->filled('password')) {
                $admin->fill($request->only(['password']));
            }

            $admin->fill($request->only(['name']));
            $admin->saveOrFail();
            $admin->syncRoles($role);

            return $admin;
        });

        return DetailAdminResource::make($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $admin)
    {
        abort_if(auth_user()->is($admin), 403, 'You cannot delete your own profile.');
        abort_if($admin->isDeveloper(), 403, 'You cannot delete the developer profile.');

        $admin->deleteOrFail();

        return response()->json(status: 204);
    }
}
