<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\AdminResendCodeEmail;
use App\Mail\AdminForgotPassword;
use App\Mail\AdminLoginAttempt;
use App\Mail\AdminPasswordChangeVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public function showAdminIndex()
    {
        return view('admin.admin_index')->with('title', 'SPENDS: Home ');
    }

    public function admin_login(Request $request)
    {
        $AdminLoginMessages = [
            'admin_email.required' => 'Enter your email.',
            'admin_password.required' => 'Enter your password.',
            'g-recaptcha-response' => 'Recaptcha field is required'
        ];

        $validated = $request->validate([
            'admin_email' => ['required', 'email'],
            'admin_password' => 'required',
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
        ], $AdminLoginMessages);

        $admin_email = $validated['admin_email'];
        $admin_throttleTime = Carbon::now()->format('Y-m-d H:i:s');

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            DB::table('admin_login_attempts')->insert([
                'admin_email' => $admin_email,
                'status' => 'Throttled',
                'created_at' => now(),
            ]);

            Mail::to($admin_email)->send(new AdminLoginAttempt($admin_email, $admin_throttleTime));

            return redirect('/admin')->with([
                'admin-error-message-header' => 'Too many attempts',
                'admin-error-message-body' => 'Please try again after 5 minutes.',
            ]);
        }

        $admin_login = Admin::where('admin_email', $admin_email)->first();

        if (!$admin_login) {
            DB::table('admin_login_attempts')->insert([
                'admin_email' => $admin_email,
                'status' => 'Failed',
                'created_at' => now(),
            ]);

            return back()->withErrors(['admin_email' => "This email doesn't exist."])->onlyInput('admin_email');
        }

        if (is_null($admin_login->admin_verified_at)) {
            return redirect()->route('admin-verify-email-login')->with([
                'admin_email' => $admin_login->admin_email,
                'showAdminVerificationModal' => true,
                'clearAdminLoginModal' => true,
                'admin-error-message-header' => 'Login Failed',
                'admin-error-message-body' => 'Verify your email first.'
            ]);
        }

        if (!Hash::check($validated['admin_password'], $admin_login->admin_password)) {
            DB::table('admin_login_attempts')->insert([
                'admin_email' => $admin_email,
                'status' => 'Failed',
                'created_at' => now(),
            ]);

            RateLimiter::hit($this->throttleKey($request), 300);

            return back()->withErrors(['admin_password' => 'Password incorrect.'])->onlyInput('admin_email');
        }

        FacadesAuth::guard('admin')->login($admin_login);
        $request->session()->regenerate();
        $request->session()->put('admin', $admin_login);

        DB::table('admin_login_attempts')->insert([
            'admin_email' => $admin_email,
            'status' => 'Successful',
            'created_at' => now(),
        ]);

        return redirect('/admin')->with([
            'admin-message-header' => 'Welcome back!',
            'admin-message-body' => 'Successfully logged in.',
            'clearAdminLoginModal' => true,
        ]);
    }

    public function throttleKey(Request $request)
    {
        return 'login:' . $request->input('admin_email');
    }

    public function admin_logout(Request $request)
    {
        FacadesAuth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Successfully logged out.'
        ]);
    }

    public function showAdminVerificationFormLogin()
    {
        if (!session()->has('admin_email')) {
            return redirect('/admin')->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect(url()->previous())->with([
            'showAdminVerificationModal' => true,
            'clearAdminLoginModal' => true,
            'admin_email' => session('admin_email'),
            'admin-error-message-header' => 'Login Failed',
            'admin-error-message-body' => 'Verify your email first.'
        ]);
    }

    public function verifyAdminEmailCodeLogin(Request $request)
    {
        $admin_email = $request->input('admin_email');
        $code = $request->input('code');

        $admin = Admin::where('admin_email', $admin_email)->first();

        if ($admin && Hash::check($code, $admin->admin_verification_code)) {

            if ($admin->admin_verification_expires_at && $admin->admin_verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $admin->admin_verified_at = now();
            $admin->admin_verification_code = null;
            $admin->admin_verification_expires_at = null;
            $admin->save();

            session()->flash('admin-message-header', 'Success');
            session()->flash('admin-message-body', 'Email verified successfully.');

            session(['showAdminLoginModal' => true]);

            return response()->json([
                'message' => 'Email verified successfully.',
                'redirect' => url()->previous(),
            ], 200);
        }

        return response()->json(['error' => 'Invalid verification code.'], 400);
    }

    public function resendAdminVerificationCode(Request $request)
    {
        $admin_email = $request->input('admin_email');

        if (empty($admin_email)) {
            $admin = Admin::latest()->first();
            $admin_email = $admin?->admin_email;
        }

        $admin = Admin::where('admin_email', $admin_email)->first();

        if ($admin) {
            if ($admin->admin_verified_at) {
                return response()->json(['error' => 'Your email is already verified.'], 200);
            }

            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $hashedVerificationCode = Hash::make($verificationCode);

            $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

            $admin->admin_verification_code = $hashedVerificationCode;
            $admin->admin_verification_expires_at = $expirationTime;
            $admin->save();

            Mail::to($admin->admin_email)->send(new AdminResendCodeEmail($verificationCode, $expirationTime));

            return response()->json(['message' => 'A new verification code has been sent to your email.'], 200);
        }

        return response()->json(['error' => 'Failed to resend verification code. Please try again.'], 400);
    }

    public function sendAdminEmailForReset(Request $request)
    {
        $ResetMessages = [
            'admin_email.required' => 'Enter your email.',
        ];

        $validated = $request->validate([
            'admin_email' => ['required', 'email'],
        ], $ResetMessages);

        $admin_reset_password = Admin::where('admin_email', $validated['admin_email'])->first();

        if (!$admin_reset_password) {
            return back()->withErrors(['admin_email' => "This email doesn't exist."])->withInput(['admin_email' => $validated['admin_email']]);
        }

        $admin_token = Str::random(30);
        $expiresAt = now()->addHour()->setTimezone('Asia/Manila');

        $admin_reset_password->update([
            'admin_token' => $admin_token,
            'admin_token_expiration' => $expiresAt,
        ]);

        $admin_email = $admin_reset_password->admin_email;

        try {
            Mail::to($admin_email)->send(new AdminForgotPassword($admin_token, $expiresAt, $admin_email));

            return redirect(url()->previous())->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Reset token has been sent to your email.',
                'clearAdminForgotPasswordModal' => true,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['admin_email' => 'Failed to send reset email. Please try again later.']);
        }
    }

    public function showAdminResetPasswordForm(Request $request)
    {
        $admin_token = $request->query('admin_token');
        $admin_email = $request->query('admin_email');

        $admin = Admin::where('admin_email', $admin_email)->first();

        if (!$admin) {
            return redirect('/admin')->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'Restricted Access.',
                'removeAdminPasswordResetModal' => true
            ]);
        }

        if (is_null($admin->admin_token) || is_null($admin->admin_token_expiration)) {
            return redirect('/admin')->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'This token has been used.',
                'removeAdminPasswordResetModal' => true
            ]);
        }

        if ($admin->admin_token_expiration <= now()) {
            return redirect('/admin')->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'Your token has expired. Request for reset link again.',
                'removeAdminPasswordResetModal' => true
            ]);
        }

        return redirect()->to('/admin?admin_token=' . urlencode($admin_token) . '&admin_email=' . urlencode($admin_email))->with([
            'showAdminPasswordResetModal' => true,
            'saveAdminPasswordResetModal' => true,
            'admin_token' => $admin_token,
            'admin_email' => $admin_email
        ]);
    }

    public function resetAdminPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_email' => 'required|email|exists:admin,admin_email',
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
            'admin_password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
            ],
        ], [
            'admin_email.required' => 'Email is required.',
            'admin_email.email' => 'Provide a valid email address.',
            'admin_email.exists' => 'This email is not registered.',
            'admin_password.required' => 'Password is required.',
            'admin_password.min' => 'Password must be at least 8 characters.',
            'admin_password.max' => 'Password cannot exceed 32 characters.',
            'admin_password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'admin_password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('admin_email', $request->input('admin_email'));
        }

        $admin = Admin::where('admin_email', $request->input('admin_email'))->first();

        if ($admin) {
            $admin->admin_password = bcrypt($request->input('admin_password'));
            $admin->admin_token = null;
            $admin->admin_token_expiration = null;
            $admin->save();

            return redirect('/admin')->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Your password has been reset successfully.',
                'removeAdminPasswordResetModal' => true
            ]);
        }

        return redirect()->route('admin-reset-password')->with([
            'saveAdminPasswordResetModal' => true,
            'admin_email' => $request->input('admin_email'),
            'admin_token' => $request->input('admin_token'),
            'admin-error-message-header' => 'Failed',
            'admin-error-message-body' => 'An error occurred while resetting your password. Please try again.'
        ]);
    }

    public function showAdminProfile($admin_id)
    {
        $admin = Admin::findOrFail($admin_id);

        return view('admin.admin_profile', [
            'admin' => $admin,
            'title' => 'Profile: ' . $admin->admin_first_name . ' ' . $admin->admin_last_name,
        ]);
    }

    public function changeAdminPassword(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email|exists:admin,admin_email',
            'admin_old_password' => 'required',
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
            'admin_password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    $admin = Admin::where('admin_email', $request->admin_email)->first();
                    if (Hash::check($value, $admin->admin_password)) {
                        $fail('The new password must not be the same as the old password.');
                    }
                },
            ],
        ], [
            'admin_email.required' => 'Email is required.',
            'admin_email.email' => 'Provide a valid email address.',
            'admin_email.exists' => 'This email is not registered.',
            'admin_old_password' => 'Current Password is required',
            'admin_password.required' => 'Password is required.',
            'admin_password.min' => 'Password must be at least 8 characters.',
            'admin_password.max' => 'Password cannot exceed 32 characters.',
            'admin_password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'admin_password.confirmed' => 'Password confirmation does not match.',
        ]);

        $admin = Admin::where('admin_email', $request->admin_email)->first();

        if (!Hash::check($request->admin_old_password, $admin->admin_password)) {
            return back()->withErrors(['admin_old_password' => 'The current password is incorrect.']);
        }

        $admin_change_password_verification_code = rand(100000, 999999);
        session([
            'admin_change_password_verification_code' => $admin_change_password_verification_code,
            'admin_password' => $request->admin_password,
            'admin_email' => $request->admin_email,
        ]);

        Mail::to($admin->admin_email)->send(new AdminPasswordChangeVerificationCode($admin_change_password_verification_code));

        session()->flash('showAdminChangePasswordEmailVerifyModal', true);

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'A verification code has been sent to your email.'
        ]);
    }

    public function verifyAdminChangePasswordCode(Request $request)
    {
        $request->validate([
            'admin_verification_code' => 'required|numeric',
        ]);

        if ($request->admin_verification_code != session('admin_change_password_verification_code')) {
            return back()->withErrors(['admin_verification_code' => 'The verification code is incorrect.']);
        }

        $admin = Admin::where('admin_email', session('admin_email'))->first();

        if (!$admin) {
            return back()->withErrors(['admin_email' => 'No user found with this email.']);
        }

        $admin->admin_password = Hash::make(session('admin_password'));
        $admin->save();

        session()->forget('admin_change_password_verification_code');
        session()->forget('admin_password');
        session()->flash('clearAdminChangePasswordEmailVerifyModal', true);
        session()->flash('clearAdminChangePasswordModal', true);

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Password changed successfully.'
        ]);
    }

    public function editAdminProfilePicture(Request $request)
    {
        $request->validate([
            'admin_profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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

        $adminId = auth()->guard('admin')->id();
        $admin = Admin::find($adminId);
        $admin_ID = $admin->admin_id;

        if ($request->hasFile('admin_profile_picture')) {
            $request->validate([
                'admin_profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096',
            ]);

            $profilePictureFilename = $admin_ID . '.' . $request->file('admin_profile_picture')->getClientOriginalExtension();

            if ($admin->admin_profile_picture) {
                @unlink(public_path('storage/images/admin/admin_profile_picture/' . $admin->admin_profile_picture));
                @unlink(public_path('storage/images/admin/admin_thumbnail_profile/' . $admin->admin_profile_picture));
            }

            $request->file('admin_profile_picture')->storeAs('images/admin/admin_profile_picture', $profilePictureFilename);
            $admin->admin_profile_picture = $profilePictureFilename;

            $thumbnailPath = 'storage/images/admin/admin_thumbnail_profile/' . $profilePictureFilename;
            $this->createThumbnail(public_path('storage/images/admin/admin_profile_picture/' . $profilePictureFilename), public_path($thumbnailPath), 150, 150);

            $admin->save();

            return redirect('/admin/profile/' . $adminId)->with([
                'clearAdminEditProfilePictureModal' => true,
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Profile picture updated successfully.'
            ]);
        }

        return redirect('/admin/profile/' . $adminId)->with([
            'clearAdminEditProfilePictureModal' => true,
            'admin-error-message-header' => 'No File Selected',
            'admin-error-message-body' => 'No changes has been made.'
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

    public function editAdminProfile(Request $request)
    {
        $request->validate([
            'admin_first_name' => 'required|string|max:255',
            'admin_middle_name' => 'nullable|string|max:255',
            'admin_last_name' => 'required|string|max:255',
            'admin_suffix' => 'nullable|string|max:255',
            'admin_email' => 'required|email|unique:admin,admin_email,' . auth()->guard('admin')->id(),
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

        $adminId = auth()->guard('admin')->id();
        $admin = Admin::find($adminId);

        $originalValues = $admin->getOriginal();

        $admin->admin_first_name = $request->admin_first_name;
        $admin->admin_middle_name = $request->admin_middle_name;
        $admin->admin_last_name = $request->admin_last_name;
        $admin->admin_suffix = $request->admin_suffix;
        $admin->admin_email = $request->admin_email;

        $changesMade = false;
        if (
            $admin->admin_first_name !== $originalValues['admin_first_name'] ||
            $admin->admin_middle_name !== $originalValues['admin_middle_name'] ||
            $admin->admin_last_name !== $originalValues['admin_last_name'] ||
            $admin->admin_suffix !== $originalValues['admin_suffix'] ||
            $admin->admin_email !== $originalValues['admin_email']
        ) {
            $changesMade = true;
        }

        if (!$changesMade) {
            return redirect('/admin/profile/' . $adminId)->with([
                'clearAdminEditProfileModal' => true,
                'admin-error-message-header' => 'No Changes Made',
                'admin-error-message-body' => 'You did not make any changes to your profile.'
            ]);
        }

        $updatedData = [
            'admin_first_name' => $request->admin_first_name,
            'admin_middle_name' => $request->admin_middle_name,
            'admin_last_name' => $request->admin_last_name,
            'admin_suffix' => $request->admin_suffix,
            'admin_email' => $request->admin_email,
        ];
        session(['updated_profile_data' => $updatedData]);

        return redirect('/admin/profile/' . $adminId)->with([
            'showAdminVerifyCurrentPasswordModal' => true,
            'admin-message-header' => 'Confirm Your Password',
            'admin-message-body' => 'Please confirm your password to proceed with the changes.'
        ]);
    }

    public function verifyAdminPasswordForEditProfile(Request $request)
    {
        $request->validate([
            'admin_current_password' => 'required|string',
        ]);

        $admin = $request->user();
        if ($admin && Hash::check($request->admin_current_password, $admin->admin_password)) {

            $updatedData = session('updated_profile_data');

            if ($updatedData) {
                $admin->admin_first_name = $updatedData['admin_first_name'];
                $admin->admin_middle_name = $updatedData['admin_middle_name'];
                $admin->admin_last_name = $updatedData['admin_last_name'];
                $admin->admin_suffix = $updatedData['admin_suffix'];
                $admin->admin_email = $updatedData['admin_email'];

                $admin->save();

                session()->forget('updated_profile_data');

                return redirect('/admin/profile/' . $admin->id)->with([
                    'clearAdminEditProfileModal' => true,
                    'clearAdminVerifyCurrentPasswordModal' => true,
                    'admin-message-header' => 'Success',
                    'admin-message-body' => 'Profile updated successfully.'
                ]);
            }
        } else {
            return redirect()->back()->withErrors(['admin_current_password' => 'Password is incorrect.']);
        }
    }

}
