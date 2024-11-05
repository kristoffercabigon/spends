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
use App\Mail\EncoderVerificationEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\StoreEncoderRequest;

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

        return redirect()->route('encoder-verify-email')->with([
            'encoder_email' => $encoder->encoder_email,
            'code' => $encoder->verification_code,
            'showEncoderVerificationModal' => true,
            'encoder-message' => 'Registration successful. Please verify your email.'
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

    public function showVerificationFormRegister()
    {
        if (!session()->has('encoder_email')) {
            return redirect('/encoder')->with([
                'encoder-error-message' => 'Restricted Access.',
            ]);
        }

        return redirect(url()->previous())->with([
            'showEncoderVerificationModal' => true,
            'closeEncoderRegisterModal' => true,
            'encoder_email' => session('encoder_email'),
            'code' => session('encoder_code'),
            'encoder-message' => 'Registration successful. Please verify your email.'
        ]);
    }

    public function verifyEmailCodeRegister(Request $request)
    {

        $encoder_email = $request->input('encoder_email');
        $code = $request->input('code');

        $encoder = Encoder::where('encoder_email', $encoder_email)
            ->where('encoder_verification_code', $code)
            ->first();

        if ($encoder) {
            if ($encoder->verification_expires_at && $encoder->verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $encoder->verified_at = now();
            $encoder->verification_code = null;
            $encoder->verification_expires_at = null;
            $encoder->save();

            session()->flash('encoder-message', 'Email verified successfully.');

            return response()->json(['encoder-message' => 'Email verified successfully.', 'redirect' => url()->previous()], 200);
        }

        return response()->json(['error' => 'Invalid verification code.'], 400);
    }
}
