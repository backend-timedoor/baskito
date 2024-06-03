<?php

namespace App\Http\Controllers\API\Admin\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth:api-admin')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Foundation\Auth\User  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return JsonResource::make($user->only([
            'id',
            'name',
            'email',
        ]));
    }

    /**
     * The user has logged out of the application.
     *
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return response()->json(status: 204);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('api-admin');
    }
}
