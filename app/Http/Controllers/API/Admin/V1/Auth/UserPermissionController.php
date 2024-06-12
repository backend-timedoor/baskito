<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPermissionController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return JsonResource::collection(
            auth_user()->getPermissions()->map->only('name', 'slug')
        );
    }
}
