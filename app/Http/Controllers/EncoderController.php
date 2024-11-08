<?php

namespace App\Http\Controllers;

use App\Models\Encoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EncoderResendCodeEmail;
use App\Mail\EncoderVerificationEmail;
use App\Mail\EncoderForgotPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\StoreEncoderRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class EncoderController extends Controller
{
    public function showEncoderIndex()
    {
        return view('encoder.encoder_index')->with('title', 'SPENDS: Home ');
    }

    public function encoder_login(Request $request)
    {

        $EncoderLoginMessages = [
            'encoder_email.required' => 'Enter your email.',
            'encoder_password.required' => 'Enter your password.',
            'g-recaptcha-response' => 'Recaptcha field is required'
        ];

        $validated = $request->validate([
            'encoder_email' => ['required', 'email'],
            'encoder_password' => 'required',
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
        ], $EncoderLoginMessages);

        $encoder_login = Encoder::where('encoder_email', $validated['encoder_email'])->first();

        if (!$encoder_login) {
            return back()->withErrors(['encoder_email' => "This email doesn't exist."])->onlyInput('encoder_email');
        }

        if (is_null($encoder_login->encoder_verified_at)) {
            return redirect()->route('encoder-verify-email-login')->with([
                'encoder_email' => $encoder_login->encoder_email,
                'showEncoderVerificationModal' => true,
                'clearEncoderLoginModal' => true,
                'encoder-error-message-header' => 'Login Failed',
                'encoder-error-message-body' => 'Verify your email first.'
            ]);
        }

        if (!Hash::check($validated['encoder_password'], $encoder_login->encoder_password)) {
            return back()->withErrors(['encoder_password' => 'Password incorrect.'])->onlyInput('encoder_email');
        }

        FacadesAuth::login($encoder_login);
        $request->session()->regenerate();

        $request->session()->put('encoder', $encoder_login);

        return redirect('/encoder')->with([
            'encoder-message-header' => 'Welcome back!',
            'encoder-message-body' => 'Successfully logged in.',
            'clearEncoderLoginModal' => true,
        ]);
    }

    public function showEncoderVerificationFormLogin()
    {
        if (!session()->has('encoder_email')) {
            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect('/encoder')->with([
            'showEncoderVerificationModal' => true,
            'clearEncoderLoginModal' => true,
            'encoder_email' => session('encoder_email'),
            'encoder-error-message-header' => 'Login Failed',
            'encoder-error-message-body' => 'Verify your email first.'
        ]);
    }

    // HUWAG IDELETE, MAGAGMIT PA MAMAYA, KAILANGAN BAGUHIN YUNG CONTENT NG DESTINATION

    public function encoder_store(StoreEncoderRequest $request)
    {
        //dd($request->all());

        $validated = $request->validated();

        $encoderData = $validated;
        unset($encoderData['g-recaptcha-response']);

        do {
            $encoder_id = rand(1000, 9999);
        } while (DB::table('encoder')->where('encoder_id', $encoder_id)->exists());

        $encoderData['encoder_id'] = $encoder_id;

        if ($request->hasFile('encoder_profile_picture')) {
            $request->validate([
                'encoder_profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096',
            ]);

            $profilePictureFilename = $encoder_id;
            $profilePictureExtension = $request->file('encoder_profile_picture')->getClientOriginalExtension();
            $profilePictureFilenameToStore = $profilePictureFilename . '.' . $profilePictureExtension;

            $request->file('encoder_profile_picture')->storeAs('images/encoder/encoder_profile_picture', $profilePictureFilenameToStore);
            $encoderData['encoder_profile_picture'] = $profilePictureFilenameToStore;

            $thumbnailFilename = $profilePictureFilename . '.' . $profilePictureExtension;
            $thumbnailPath = 'storage/images/encoder/encoder_thumbnail_profile/' . $thumbnailFilename;

            $request->file('encoder_profile_picture')->storeAs('images/encoder/encoder_thumbnail_profile', $thumbnailFilename);

            $this->createThumbnail(public_path('storage/images/encoder/encoder_profile_picture/' . $profilePictureFilenameToStore), public_path($thumbnailPath), 150, 150);
        }

        $encoderData['encoder_password'] = Hash::make($encoderData['encoder_password']);

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $encoderData['encoder_verification_code'] = $verificationCode;
        $encoderData['encoder_verification_expires_at'] = $expirationTime;

        $encoder = Encoder::create($encoderData);

        Mail::to($encoderData['encoder_email'])->send(new EncoderVerificationEmail($verificationCode, $expirationTime));

        // return redirect()->route('encoder-verify-email')->with([
        //     'encoder_email' => $encoder->encoder_email,
        //     'code' => $encoder->verification_code,
        //     'showEncoderVerificationModal' => true,
        //     'encoder-message' => 'Registration successful. Please verify your email.'
        // ]);
    }

    function createThumbnail($sourcePath, $targetPath, $maxWidth, $maxHeight)
    {
        $manager = new ImageManager(new Driver('gd'));
        $img = $manager->read($sourcePath);

        $img->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($targetPath);
    }

    public function verifyEncoderEmailCodeLogin(Request $request)
    {
        $encoder_email = $request->input('encoder_email');
        $code = $request->input('code');

        $encoder = Encoder::where('encoder_email', $encoder_email)
            ->where('encoder_verification_code', $code)
            ->first();

        if ($encoder) {
            if ($encoder->encoder_verification_expires_at && $encoder->encoder_verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $encoder->encoder_verified_at = now();
            $encoder->encoder_verification_code = null;
            $encoder->encoder_verification_expires_at = null;
            $encoder->save();

            session(['showEncoderLoginModal' => true,]);

            return response()->json([
                'message' => 'Email verified successfully.',
                'redirect' => url()->previous(),
            ], 200);
        }

        return response()->json(['error' => 'Invalid verification code.'], 400);
    }

    public function resendEncoderVerificationCode(Request $request)
    {
        $encoder_email = $request->input('encoder_email');

        if (empty($encoder_email)) {
            $encoder = Encoder::latest()->first();
            $encoder_email = $encoder?->encoder_email;
        }

        $encoder = Encoder::where('encoder_email', $encoder_email)->first();

        if ($encoder) {
            if ($encoder->encoder_verified_at) {
                return response()->json(['error' => 'Your email is already verified.'], 200);
            }

            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

            $encoder->encoder_verification_code = $verificationCode;
            $encoder->encoder_verification_expires_at = $expirationTime;
            $encoder->save();

            Mail::to($encoder->encoder_email)->send(new EncoderResendCodeEmail($verificationCode, $expirationTime));

            return response()->json(['message' => 'A new verification code has been sent to your email.'], 200);
        }

        return response()->json(['error' => 'Failed to resend verification code. Please try again.'], 400);
    }

    public function sendEncoderEmailForReset(Request $request)
    {
        $ResetMessages = [
            'encoder_email.required' => 'Enter your email.',
        ];

        $validated = $request->validate([
            'encoder_email' => ['required', 'email'],
        ], $ResetMessages);

        $encoder_reset_password = Encoder::where('encoder_email', $validated['encoder_email'])->first();

        if (!$encoder_reset_password) {
            return back()->withErrors(['encoder_email' => "This email doesn't exist."])->withInput(['encoder_email' => $validated['encoder_email']]);
        }

        $encoder_token = Str::random(30);
        $expiresAt = now()->addHour()->setTimezone('Asia/Manila');

        $encoder_reset_password->update([
            'encoder_token' => $encoder_token,
            'encoder_token_expiration' => $expiresAt,
        ]);

        $encoder_email = $encoder_reset_password->encoder_email;

        try {
            Mail::to($encoder_email)->send(new EncoderForgotPassword($encoder_token, $expiresAt, $encoder_email));

            return redirect(url()->previous())->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Reset token has been sent to your email.',
                'clearEncoderForgotPasswordModal' => true,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['encoder_email' => 'Failed to send reset email. Please try again later.']);
        }
    }

    public function showEncoderResetPasswordForm(Request $request)
    {
        $encoder_token = $request->query('encoder_token');
        $encoder_email = $request->query('encoder_email');

        $encoder = Encoder::where('encoder_email', $encoder_email)->first();

        if (!$encoder) {
            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'Restricted Access.',
                'removeEncoderPasswordResetModal' => true
            ]);
        }

        if (is_null($encoder->encoder_token) || is_null($encoder->encoder_token_expiration)) {
            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'This token has been used.',
                'removeEncoderPasswordResetModal' => true
            ]);
        }

        if ($encoder->encoder_token_expiration <= now()) {
            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'Your token has expired. Request for reset link again.',
                'removeEncoderPasswordResetModal' => true
            ]);
        }

        return redirect()->to('/encoder?encoder_token=' . urlencode($encoder_token) . '&encoder_email=' . urlencode($encoder_email))->with([
            'showEncoderPasswordResetModal' => true,
            'saveEncoderPasswordResetModal' => true,
            'encoder_token' => $encoder_token,
            'encoder_email' => $encoder_email
        ]);
    }

    public function resetEncoderPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'encoder_email' => 'required|email|exists:encoder,encoder_email',
            'encoder_password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
            ],
        ], [
            'encoder_email.required' => 'Email is required.',
            'encoder_email.email' => 'Provide a valid email address.',
            'encoder_email.exists' => 'This email is not registered.',
            'encoder_password.required' => 'Password is required.',
            'encoder_password.min' => 'Password must be at least 8 characters.',
            'encoder_password.max' => 'Password cannot exceed 32 characters.',
            'encoder_password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'encoder_password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('encoder_email', $request->input('encoder_email'));
        }

        $encoder = Encoder::where('encoder_email', $request->input('encoder_email'))->first();

        if ($encoder) {
            $encoder->encoder_password = bcrypt($request->input('encoder_password'));
            $encoder->encoder_token = null;
            $encoder->encoder_token_expiration = null;
            $encoder->save();

            return redirect('/encoder')->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Your password has been reset successfully.',
                'removeEncoderPasswordResetModal' => true
            ]);
        }

        return redirect()->route('encoder-reset-password')->with([
            'saveEncoderPasswordResetModal' => true,
            'encoder_email' => $request->input('encoder_email'),
            'encoder_token' => $request->input('encoder_token'),
            'encoder-error-message-header' => 'Failed',
            'encoder-error-message-body' => 'An error occurred while resetting your password. Please try again.'
        ]);
    }

    public function encoder_logout(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url()->previous())->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Successfully logged out.'
        ]);
    }

}
