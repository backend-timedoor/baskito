<?php

namespace App\Http\Controllers\API\Admin\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use jeremykenedy\LaravelRoles\Models\Role;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return JsonResource::collection(
            Role::query()->oldest('slug')->get(['slug', 'name'])
        );
    }
}
