<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        $recaptcha = new \ReCaptcha\ReCaptcha("6LeX2PQpAAAAAAiALX5gOf8xekeJVRXsck5pBO4e");

        $gRecaptchaResponse = $_POST['g-recaptcha-response'];
        $remoteIp = $request->ip();

        $resp = $recaptcha->setExpectedHostname('album_secu.com')
            ->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {


            $request->authenticate();

            $request->session()->regenerate();

            return redirect(route('user.album', absolute: false));
        } else {
            $errors = $resp->getErrorCodes();
            return redirect()->back()->withErrors(['captcha' => 'ReCaptcha verification failed. Please try again.'])->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
