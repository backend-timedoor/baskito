<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Admin\V1\Auth\MeResource;

class MeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): MeResource
    {
        return MeResource::make(auth_user());
    }
}
