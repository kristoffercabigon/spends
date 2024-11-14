<?php

namespace App\Http\Controllers;

use App\Models\Encoder;
use App\Models\Guest;
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
use App\Mail\EncoderLoginAttempt;
use App\Mail\EncoderPasswordChangeVerificationCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\StoreEncoderRequest;


class EncoderController extends Controller
{
    public function showEncoderIndex()
    {
        return view('encoder.encoder_index')->with('title', 'Home');
    }

    public function contact_us()
    {
        return view('encoder.encoder_contact_us')->with('title', 'Contact Us ');
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:40',
            'subject' => 'required|max:100',
            'message' => 'required',
        ], [
            'name.required' => 'Please enter your name.',
            'name.max' => 'The name should not exceed 50 characters.',

            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email should not exceed 40 characters.',

            'subject.required' => 'Please enter a subject for your message.',
            'subject.max' => 'The subject should not exceed 100 characters.',

            'message.required' => 'Please enter your message.',
        ]);

        Guest::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with([
            'message-header' => 'Success',
            'message-body' => 'Your message has been sent successfully!'
        ]);
    }

    public function encoder_login(Request $request)
    {
        $EncoderLoginMessages = [
            'encoder_email.required' => 'Enter your email.',
            'encoder_password.required' => 'Enter your password.',
            'g-recaptcha-response' => 'Recaptcha field is required',
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

        $encoder_email = $validated['encoder_email'];
        $encoder_throttleTime = Carbon::now()->format('Y-m-d H:i:s');

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            DB::table('encoder_login_attempts')->insert([
                'encoder_email' => $encoder_email,
                'status' => 'Throttled',
                'created_at' => now(),
            ]);

            Mail::to($encoder_email)->send(new EncoderLoginAttempt($encoder_email, $encoder_throttleTime));

            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Too many attempts',
                'encoder-error-message-body' => 'Please try again after 5 minutes.',
            ]);
        }

        $encoder_login = Encoder::where('encoder_email', $encoder_email)->first();
        if (!$encoder_login) {
            DB::table('encoder_login_attempts')->insert([
                'encoder_email' => $encoder_email,
                'status' => 'Failed',
                'created_at' => now(),
            ]);

            return back()->withErrors(['encoder_email' => "This email doesn't exist."])->onlyInput('encoder_email');
        }

        if (is_null($encoder_login->encoder_verified_at)) {
            return redirect()->route('encoder-verify-email-login')->with([
                'encoder_email' => $encoder_login->encoder_email,
                'showEncoderVerificationModal' => true,
                'clearEncoderLoginModal' => true,
                'encoder-error-message-header' => 'Login Failed',
                'encoder-error-message-body' => 'Verify your email first.',
            ]);
        }

        if (!Hash::check($validated['encoder_password'], $encoder_login->encoder_password)) {
            DB::table('encoder_login_attempts')->insert([
                'encoder_email' => $encoder_email,
                'status' => 'Failed',
                'created_at' => now(),
            ]);

            RateLimiter::hit($this->throttleKey($request), 300);

            return back()->withErrors(['encoder_password' => 'Password incorrect.'])->onlyInput('encoder_email');
        }

        FacadesAuth::guard('encoder')->login($encoder_login);
        $request->session()->regenerate();
        $request->session()->put('encoder', $encoder_login);

        DB::table('encoder_login_attempts')->insert([
            'encoder_email' => $encoder_email,
            'status' => 'Successful',
            'created_at' => now(),
        ]);

        return redirect('/encoder')->with([
            'encoder-message-header' => 'Welcome back!',
            'encoder-message-body' => 'Successfully logged in.',
            'clearEncoderLoginModal' => true,
        ]);
    }

    public function throttleKey(Request $request)
    {
        return 'login:' . $request->input('encoder_email');
    }

    public function showEncoderVerificationFormLogin()
    {
        if (!session()->has('encoder_email')) {
            return redirect('/encoder')->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect(url()->previous())->with([
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
        $hashedVerificationCode = Hash::make($verificationCode);

        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $encoderData['encoder_verification_code'] = $hashedVerificationCode;
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

    public function verifyEncoderEmailCodeLogin(Request $request)
    {
        $encoder_email = $request->input('encoder_email');
        $code = $request->input('code');

        $encoder = Encoder::where('encoder_email', $encoder_email)->first();

        if ($encoder && Hash::check($code, $encoder->encoder_verification_code)) {

            if ($encoder->encoder_verification_expires_at && $encoder->encoder_verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $encoder->encoder_verified_at = now();
            $encoder->encoder_verification_code = null;
            $encoder->encoder_verification_expires_at = null;
            $encoder->save();

            session()->flash('encoder-message-header', 'Success');
            session()->flash('encoder-message-body', 'Email verified successfully.');

            session(['showEncoderLoginModal' => true]);

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
            $hashedVerificationCode = Hash::make($verificationCode);

            $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

            $encoder->encoder_verification_code = $hashedVerificationCode;
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
        FacadesAuth::guard('encoder')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/encoder')->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Successfully logged out.'
        ]);
    }

    public function showEncoderProfile($encoder_id)
    {
        $encoder = Encoder::findOrFail($encoder_id);

        return view('encoder.encoder_profile', [
            'encoder' => $encoder,
            'title' => 'Profile: ' . $encoder->encoder_first_name . ' ' . $encoder->encoder_last_name,
        ]);
    }

    public function changeEncoderPassword(Request $request)
    {
        $request->validate([
            'encoder_email' => 'required|email|exists:encoder,encoder_email',
            'encoder_old_password' => 'required',
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
            'encoder_password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    $encoder = Encoder::where('encoder_email', $request->encoder_email)->first();
                    if (Hash::check($value, $encoder->encoder_password)) {
                        $fail('The new password must not be the same as the old password.');
                    }
                },
            ],
        ], [
            'encoder_email.required' => 'Email is required.',
            'encoder_email.email' => 'Provide a valid email address.',
            'encoder_email.exists' => 'This email is not registered.',
            'encoder_old_password' => 'Current Password is required',
            'encoder_password.required' => 'Password is required.',
            'encoder_password.min' => 'Password must be at least 8 characters.',
            'encoder_password.max' => 'Password cannot exceed 32 characters.',
            'encoder_password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'encoder_password.confirmed' => 'Password confirmation does not match.',
        ]);

        $encoder = Encoder::where('encoder_email', $request->encoder_email)->first();

        if (!Hash::check($request->encoder_old_password, $encoder->encoder_password)) {
            return back()->withErrors(['encoder_old_password' => 'The current password is incorrect.']);
        }

        $encoder_change_password_verification_code = rand(100000, 999999);
        session([
            'encoder_change_password_verification_code' => $encoder_change_password_verification_code,
            'encoder_password' => $request->encoder_password,
            'encoder_email' => $request->encoder_email,
        ]);

        Mail::to($encoder->encoder_email)->send(new EncoderPasswordChangeVerificationCode($encoder_change_password_verification_code));

        session()->flash('showEncoderChangePasswordEmailVerifyModal', true);

        return redirect()->back()->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'A verification code has been sent to your email.'
        ]);
    }

    public function verifyEncoderChangePasswordCode(Request $request)
    {
        $request->validate([
            'encoder_verification_code' => 'required|numeric',
        ]);

        if ($request->encoder_verification_code != session('encoder_change_password_verification_code')) {
            return back()->withErrors(['encoder_verification_code' => 'The verification code is incorrect.']);
        }

        $encoder = Encoder::where('encoder_email', session('encoder_email'))->first();

        if (!$encoder) {
            return back()->withErrors(['encoder_email' => 'No user found with this email.']);
        }

        $encoder->encoder_password = Hash::make(session('encoder_password'));
        $encoder->save();

        session()->forget('encoder_change_password_verification_code');
        session()->forget('encoder_password');
        session()->flash('clearEncoderChangePasswordEmailVerifyModal', true);
        session()->flash('clearEncoderChangePasswordModal', true);

        return redirect()->back()->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Password changed successfully.'
        ]);
    }

    public function editEncoderProfilePicture(Request $request)
    {
        $request->validate([
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
            'encoder_profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $encoderId = auth()->guard('encoder')->id();
        $encoder = Encoder::find($encoderId);
        $encoder_ID = $encoder->encoder_id;

        if ($request->hasFile('encoder_profile_picture')) {
            $request->validate([
                'encoder_profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096',
            ]);

            $profilePictureFilename = $encoder_ID . '.' . $request->file('encoder_profile_picture')->getClientOriginalExtension();

            if ($encoder->encoder_profile_picture) {
                @unlink(public_path('storage/images/encoder/encoder_profile_picture/' . $encoder->encoder_profile_picture));
                @unlink(public_path('storage/images/encoder/encoder_thumbnail_profile/' . $encoder->encoder_profile_picture));
            }

            $request->file('encoder_profile_picture')->storeAs('images/encoder/encoder_profile_picture', $profilePictureFilename);
            $encoder->encoder_profile_picture = $profilePictureFilename;

            $thumbnailPath = 'storage/images/encoder/encoder_thumbnail_profile/' . $profilePictureFilename;
            $this->createThumbnail(public_path('storage/images/encoder/encoder_profile_picture/' . $profilePictureFilename), public_path($thumbnailPath), 150, 150);

            $encoder->save();

            return redirect('/encoder/profile/' . $encoderId)->with([
                'clearEncoderEditProfilePictureModal' => true,
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Profile picture updated successfully.'
            ]);
        }

        return redirect('/encoder/profile/' . $encoderId)->with([
            'clearEncoderEditProfilePictureModal' => true,
            'encoder-error-message-header' => 'No File Selected',
            'encoder-error-message-body' => 'No changes has been made.'
        ]);
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

    public function editEncoderProfile(Request $request)
    {
        $request->validate([
            'encoder_first_name' => 'required|string|max:255',
            'encoder_middle_name' => 'nullable|string|max:255',
            'encoder_last_name' => 'required|string|max:255',
            'encoder_suffix' => 'nullable|string|max:255',
            'encoder_email' => 'required|email|unique:encoder,encoder_email,' . auth()->guard('encoder')->id(),
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
        ]);

        $encoderId = auth()->guard('encoder')->id();
        $encoder = Encoder::find($encoderId);

        $originalValues = $encoder->getOriginal();

        $encoder->encoder_first_name = $request->encoder_first_name;
        $encoder->encoder_middle_name = $request->encoder_middle_name;
        $encoder->encoder_last_name = $request->encoder_last_name;
        $encoder->encoder_suffix = $request->encoder_suffix;
        $encoder->encoder_email = $request->encoder_email;

        $changesMade = false;
        if (
            $encoder->encoder_first_name !== $originalValues['encoder_first_name'] ||
            $encoder->encoder_middle_name !== $originalValues['encoder_middle_name'] ||
            $encoder->encoder_last_name !== $originalValues['encoder_last_name'] ||
            $encoder->encoder_suffix !== $originalValues['encoder_suffix'] ||
            $encoder->encoder_email !== $originalValues['encoder_email']
        ) {
            $changesMade = true;
        }

        if (!$changesMade) {
            return redirect('/encoder/profile/' . $encoderId)->with([
                'clearEncoderEditProfileModal' => true,
                'encoder-error-message-header' => 'No Changes Made',
                'encoder-error-message-body' => 'You did not make any changes to your profile.'
            ]);
        }

        $updatedData = [
            'encoder_first_name' => $request->encoder_first_name,
            'encoder_middle_name' => $request->encoder_middle_name,
            'encoder_last_name' => $request->encoder_last_name,
            'encoder_suffix' => $request->encoder_suffix,
            'encoder_email' => $request->encoder_email,
        ];
        session(['updated_profile_data' => $updatedData]);

        return redirect('/encoder/profile/' . $encoderId)->with([
            'showEncoderVerifyCurrentPasswordModal' => true,
            'encoder-message-header' => 'Confirm Your Password',
            'encoder-message-body' => 'Please confirm your password to proceed with the changes.'
        ]);
    }

    public function verifyEncoderPasswordForEditProfile(Request $request)
    {
        $request->validate([
            'encoder_current_password' => 'required|string',
        ]);

        $encoder = $request->user(); 
        if ($encoder && Hash::check($request->encoder_current_password, $encoder->encoder_password)) {

            $updatedData = session('updated_profile_data');

            if ($updatedData) {
                $encoder->encoder_first_name = $updatedData['encoder_first_name'];
                $encoder->encoder_middle_name = $updatedData['encoder_middle_name'];
                $encoder->encoder_last_name = $updatedData['encoder_last_name'];
                $encoder->encoder_suffix = $updatedData['encoder_suffix'];
                $encoder->encoder_email = $updatedData['encoder_email'];

                $encoder->save();

                session()->forget('updated_profile_data');

                return redirect('/encoder/profile/' . $encoder->id)->with([
                    'clearEncoderEditProfileModal' => true,
                    'clearEncoderVerifyCurrentPasswordModal' => true,
                    'encoder-message-header' => 'Success',
                    'encoder-message-body' => 'Profile updated successfully.'
                ]);
            }
        } else {
            return redirect()->back()->withErrors(['encoder_current_password' => 'Password is incorrect.']);
        }
    }

}
