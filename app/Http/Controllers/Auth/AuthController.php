<?php

namespace blogCms\Http\Controllers\Auth;

use Auth; 

use blogCms\User;
use blogCms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Class AuthController
 * @package blogCms\Http\Controllers\Auth
 */
class AuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->redirectAfterLogout = route('auth.login');

        $this->redirectTo = route('backend.dashboard');

        $this->middleware('guest', ['except' => 'getLogout']);
    }
}
