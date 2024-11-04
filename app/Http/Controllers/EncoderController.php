<?php

namespace App\Http\Controllers;

use App\Models\Encoder;
use Illuminate\Http\Request;
use App\Mail\SeniorForgotPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SeniorResendCodeEmail;
use App\Mail\SeniorVerificationEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\StoreSeniorRequest as RequestsStoreSeniorRequest;

class EncoderController extends Controller
{
    public function encoder_index()
    {
        return view('encoder.encoder_index')->with('title', 'SPENDS: Home ');
    }

    public function encoder_login(Request $request)
    {
        $loginMessages = [
            'email.required' => 'Enter your email.',
            'password.required' => 'Enter your password.',
            'g-recaptcha-response' => 'Recaptcha field is required'
        ];

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            "g-recaptcha-response" => ['required', function ($attribute, $value, $fail) use ($request) {
                $secret = env('RECAPTCHA_SECRET_KEY');
                $response = $request->input('g-recaptcha-response');
                $remoteip = $request->ip();

                $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}&remoteip={$remoteip}");
                $captcha_success = json_decode($verify);

                if (!$captcha_success->success) {
                    $fail('ReCaptcha verification failed, please try again.');
                }
            }],
        ], $loginMessages);

        $senior_login = Encoder::where('email', $validated['email'])->first();

        if (!$senior_login) {
            return back()->withErrors(['email' => "This email doesn't exist."])->onlyInput('email');
        }

        if (is_null($senior_login->verified_at)) {
            return redirect()->route('verify-email-login')->with([
                'email' => $senior_login->email,
                'showVerificationModal' => true,
                'clearLoginModal' => true,
                'error-message' => 'Login Failed. Verify your email first.',
            ]);
        }

        if (!Hash::check($validated['password'], $senior_login->password)) {
            return back()->withErrors(['password' => 'Password incorrect.'])->onlyInput('email');
        }

        FacadesAuth::login($senior_login);
        $request->session()->regenerate();

        $request->session()->put('senior', $senior_login);

        return redirect('/')->with([
            'message' => 'Welcome back!',
            'clearLoginModal' => true,
        ]);
    }
}
