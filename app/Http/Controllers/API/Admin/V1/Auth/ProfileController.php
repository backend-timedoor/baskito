<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\V1\Auth\Profile\UpdateRequest;
use App\Http\Resources\API\Admin\V1\Auth\ProfileResource;

class ProfileController extends Controller
{
    public function show(): ProfileResource
    {
        return ProfileResource::make(auth_user());
    }

    public function update(UpdateRequest $request): ProfileResource
    {
        $user = auth_user();

        $user->updateOrFail($request->only(['name']));

        return ProfileResource::make($user);
    }
}
