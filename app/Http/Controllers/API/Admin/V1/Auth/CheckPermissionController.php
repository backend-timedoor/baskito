<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\V1\Auth\Permission\CheckPermissionRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckPermissionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckPermissionRequest $request): JsonResource
    {
        $user = auth_user();

        $userPermissions = $user->getPermissions()->pluck('name', 'slug');

        $permissions = [];

        foreach ($request->getPermissions() as $permission) {
            $permissions[$permission] = $userPermissions->has($permission);
        }

        return JsonResource::make($permissions);
    }
}
