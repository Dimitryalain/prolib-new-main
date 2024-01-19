<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class VisiteurLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Visiteur Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating notaires for the application and
    | redirecting them to the notaire dashboard upon successful authentication.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect notaires after login.
     *
     * @var string
     */
    protected $redirectTo = '/visiteur';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:visiteur')->except('logout');
    }

    /**
     * Show the notaire login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login-visiteur');
    }

    /**
     * Get the guard to be used during notaire authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
{
    return auth()->guard('visiteur');
}

}
