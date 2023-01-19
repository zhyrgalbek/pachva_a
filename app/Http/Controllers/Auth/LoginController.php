<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use AuthenticatesUsers {
        logout as performLogout;
    }

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
    protected $decayMinutes = 3;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('services.contact');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(): string
    {
        return 'identifier';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->limiter()->attempts($this->throttleKey($request)) >= 2) {
            $this->fireLockoutEvent($request);

            $this->incrementLoginAttempts($request);

            return $this->sendRecaptchaResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (auth()->user()->hasRole('contact')) {
                $this->redirectTo = route('services.contact');
            }

            return $this->sendLoginResponse($request);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendRecaptchaResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            'is_captcha' => true,
        ]);
    }

    protected function validateLogin(Request $request)
    {
        if ($this->limiter()->attempts($this->throttleKey($request)) >= 3) {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
                'g-recaptcha-response' => ['required', 'captcha']
            ]);
        } else {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }
}
