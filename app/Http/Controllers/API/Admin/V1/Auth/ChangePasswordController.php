<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\V1\Auth\Password\UpdateRequest;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateRequest $request)
    {
        $user = auth_user();

        $user->updateOrFail([
            'password' => $request->input('new_password'),
        ]);

        return response()->json(status: 204);
    }
}
