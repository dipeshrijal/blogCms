<?php

namespace blogCms\Http\Controllers\Auth;

use blogCms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController
 * @package blogCms\Http\Controllers\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->redirectTo = route('backend.dashboard');
        
        $this->middleware('guest');
    }

    /**
     * @param $user
     * @param $password
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        auth()->login($user);
    }
}
