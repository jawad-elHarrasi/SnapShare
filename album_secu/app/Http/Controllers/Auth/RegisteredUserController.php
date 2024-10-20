<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

//require_once 'autoload.php';


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



        $recaptcha = new \ReCaptcha\ReCaptcha("6LeX2PQpAAAAAAiALX5gOf8xekeJVRXsck5pBO4e");

        $gRecaptchaResponse = $_POST['g-recaptcha-response'];
        $remoteIp = $request->ip();

        $resp = $recaptcha->setExpectedHostname('album_secu.com')
            ->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {



            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $publicKey = base64_decode($request->input('public_key'));




            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'public_key' => $publicKey,
            ]);

            event(new Registered($user));

            Auth::login($user);



            return redirect(route('user.album', absolute: false));
        } else {
            $errors = $resp->getErrorCodes();
            return redirect()->back()->withErrors(['captcha' => 'ReCaptcha verification failed. Please try again.'])->withInput();
        }
    }
}
