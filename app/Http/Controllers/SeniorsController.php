<?php

namespace App\Http\Controllers;

use App\Mail\SeniorForgotPassword;
use Illuminate\Http\Request;
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


class SeniorsController extends Controller
{
    public function index()
    {
        $data = array("seniors" => DB::table('seniors')->orderBy('created_at', 'desc')->paginate(10));
        return view('senior_citizen.index', $data)->with('title', 'SPENDS: Home ');
    }

    public function create()
    {
        $income_sources = DB::table('where_income_source_list')->get();
        $incomes = DB::table('how_much_income_list')->get();
        $pensions = DB::table('how_much_pension_list')->get();
        $sources = DB::table('source_list')->get();
        $arrangement_lists = DB::table('living_arrangement_list')->get();
        $sexes = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $barangay = DB::table('barangay_list')->get();

        return view('senior_citizen.create')->with([
            'title' => 'SPENDS: Register',
            'income_sources' => $income_sources,
            'incomes' => $incomes,
            'pensions' => $pensions,
            'sources' => $sources,
            'arrangement_lists' => $arrangement_lists,
            'sexes' => $sexes,
            'civil_status_list' => $civil_status_list, 
            'barangay' => $barangay
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $customMessages = [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 4 characters.',
            'first_name.max' => 'First name cannot exceed 60 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 4 characters.',
            'last_name.max' => 'Last name cannot exceed 30 characters.',
            'birthdate.required' => 'Birthdate is required.',
            'birthdate.age' => 'The age must be 60 years old or above.',
            'age.required' => 'Specify your birthdate to automatically indicate age.',
            'birthplace.required' => 'Birthplace is required.',
            'sex_id.required' => 'Sex is required.',
            'civil_status_id.required' => 'Civil status is required.',
            'contact_no.required' => 'Contact number is required.',
            'address.required' => 'Address is required.',
            'address.min' => 'Full address needed, press the (i) icon to see the needed info.',
            'address.max' => 'Address cannot exceed 100 characters.',
            'barangay_id.required' => 'Barangay is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 32 characters.',
            'password.regex' => 'Include 1 uppercase and lowercase letter and 1 special character.',
            'password.confirmed' => 'Password confirmation does not match.',
            'valid_id.required' => 'Valid ID is required.',
            'valid_id.mimes' => 'Valid ID must be a file of type: jpeg, png, bmp, tiff.',
            'valid_id.max' => 'Valid ID must not exceed 4096 kilobytes.',
            'profile_picture.mimes' => 'Profile picture must be a file of type: jpeg, png, bmp, tiff.',
            'indigency.required' => 'Indigency document is required.',
            'birth_certificate.required' => 'Birth certificate is required.',
            'type_of_living_arrangement.required' => 'Type of living arrangement is required.',
            'other_arrangement_remark.required_if' => 'This field is required when the type of living arrangement is 5.',
            'pensioner.required' => 'Pensioner status is required.',
            'if_pensioner_yes.required_if' => 'This field is required if you are a pensioner.',
            'source.required_if' => 'Source of pension is required if you are a pensioner.',
            'source.*.required_if' => 'Each source of pension is required if you are a pensioner.',
            'income_source.required_if' => 'Source of income is required if you have permanent source of income.',
            'income_source.*.required_if' => 'Each source of income is required if you have permanent source of income.',
            'other_source_remark.required_if' => 'This field is required if the source is "Other".',
            'permanent_source.required' => 'Permanent source of income is required.',
            'if_permanent_yes_income.required_if' => 'This field is required if the permanent source is "Yes".',
            'has_illness.required' => 'Illness status is required.',
            'if_illness_yes.required_if' => 'This field is required if you have an illness.',
            'has_disability.required' => 'Disability status is required.',
            'if_disability_yes.required_if' => 'This field is required if you have a disability.',
            'signature_data.required' => 'Signature is required.',
            'confirm-checkbox.required' => 'You must agree to the terms.',
            'g-recaptcha-response.required' => 'ReCaptcha verification is required.',
        ];

        $validated = $request->validate([
            "first_name" => ['required', 'min:4', 'max:60'],
            "last_name" => ['required', 'min:4', 'max:30'],
            "middle_name" => ['nullable'],
            "suffix" => ['nullable'],
            "birthdate" => ['required', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->age < 60) {
                    $fail('The age must be 60 years old or above.');
                }
            }],
            "age" => ['required'],
            "birthplace" => ['required'],
            "sex_id" => ['required'],
            "civil_status_id" => ['required'],
            "contact_no" => ['required'],
            "address" => ['required', 'min:20', 'max:100'],
            "barangay_id" => ['required'],
            "email" => ['required', 'email', Rule::unique('seniors', 'email')],
            "password" => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed'
            ],
            "valid_id" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            "profile_picture" => 'nullable|mimes:jpeg,png,bmp,tiff|max:4096',
            "indigency" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            "birth_certificate" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            "type_of_living_arrangement" => ['required'],
            "other_arrangement_remark" => 'required_if:type_of_living_arrangement,5',
            "pensioner" => ['required'],
            "if_pensioner_yes" => 'required_if:pensioner,1',
            'source' => ['required_if:pensioner,1', 'array'],
            'source.*' => ['required_if:pensioner,1', 'integer'],
            'other_source_remark' => 'required_if:source.*,4',
            "permanent_source" => ['required'],
            'income_source' => ['required_if:permanent_source,1', 'array'],
            'income_source.*' => ['required_if:permanent_source,1', 'integer'],
            "if_permanent_yes_income" => 'required_if:permanent_source,1',
            "has_illness" => ['required'],
            "if_illness_yes" => 'required_if:has_illness,1',
            "has_disability" => ['required'],
            "if_disability_yes" => 'required_if:has_disability,1',
            "relative_name.*" => 'nullable|string|max:255',
            "relative_relationship.*" => 'nullable|string|max:255',
            "relative_age.*" => 'nullable|integer|min:0',
            "relative_civil_status.*" => 'nullable|string|max:255',
            "relative_occupation.*" => 'nullable|string|max:255',
            "relative_income.*" => 'nullable|string|max:255',
            "signature_data" => ['required'],
            "confirm-checkbox" => ['required'],
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
        ], $customMessages);

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($seniorData['income_source'], $seniorData['other_income_source_remark']);
        unset($seniorData['g-recaptcha-response']);

        do {
            $osca_id = rand(1000, 9999);
        } while (DB::table('seniors')->where('osca_id', $osca_id)->exists());

        $seniorData['osca_id'] = $osca_id;

        if (empty($request->input('g-recaptcha-response'))) {
            $seniorData['g-recaptcha-response'] = 'The ReCaptcha field is required.';
        }

        if ($request->hasFile('valid_id')) {
            $validIdFilename = $osca_id;
            $validIdExtension = $request->file('valid_id')->getClientOriginalExtension();
            $validIdFilenameToStore = $validIdFilename . '.' . $validIdExtension;

            $request->file('valid_id')->storeAs('images/valid_id', $validIdFilenameToStore);
            $seniorData['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $profilePictureFilename = $osca_id;
            $profilePictureExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $profilePictureFilenameToStore = $profilePictureFilename . '.' . $profilePictureExtension;

            $request->file('profile_picture')->storeAs('images/profile_picture', $profilePictureFilenameToStore);
            $seniorData['profile_picture'] = $profilePictureFilenameToStore;
        }

        if ($request->hasFile('indigency')) {
            $indigencyFilename = $osca_id; 
            $indigencyExtension = $request->file('indigency')->getClientOriginalExtension();
            $indigencyFilenameToStore = $indigencyFilename . '.' . $indigencyExtension;
            $request->file('indigency')->storeAs('images/indigency', $indigencyFilenameToStore);
            $seniorData['indigency'] = $indigencyFilenameToStore;
        }

        if ($request->hasFile('birth_certificate')) {
            $birthCertificateFilename = $osca_id;
            $birthCertificateExtension = $request->file('birth_certificate')->getClientOriginalExtension();
            $birthCertificateFilenameToStore = $birthCertificateFilename . '.' . $birthCertificateExtension;

            $request->file('birth_certificate')->storeAs('images/birth_certificate', $birthCertificateFilenameToStore);
            $seniorData['birth_certificate'] = $birthCertificateFilenameToStore;
        }

        if ($request->has('signature_data')) {
            $signatureData = $request->input('signature_data');

            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFilename = $osca_id . '.png';
            $path = storage_path('app/public/images/signatures/');
            file_put_contents($path . $signatureFilename, $signatureData);

            $seniorData['signature_data'] = $signatureFilename;
        }

        $seniorData['contact_no'] = '+63' . $seniorData['contact_no'];

        $seniorData['password'] = Hash::make($seniorData['password']);

        $seniorData['date_applied'] = now();

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expirationTime = now()->addHour();

        $seniorData['verification_code'] = $verificationCode;
        $seniorData['verification_expires_at'] = $expirationTime;

        $seniors = Seniors::create($seniorData);

        Mail::to($seniorData['email'])->send(new SeniorVerificationEmail($verificationCode, $expirationTime));

        $lastSourceId = DB::table('source_list')->latest('id')->value('id');

        if ($request->input('pensioner') == 1
        ) {
            $sourceInputs = $request->input('source') ?? [];

            foreach ($sourceInputs as $source) {
                $data = [];

                if (!is_null($seniors->id)) {
                    $data['senior_id'] = $seniors->id;
                }

                if (!is_null($source)) {
                    $data['source_id'] = $source;
                }

                if ($source == $lastSourceId) {
                    $data['other_source_remark'] = $request->input('other_source_remark');
                }

                if (!empty($data)) {
                    DB::table('source')->insert($data);
                }
            }
        }

        $lastIncomeSourceId = DB::table('where_income_source_list')->latest('id')->value('id');

        if ($request->input('permanent_source') == 1) {
            $incomeSourceInputs = $request->input('income_source') ?? [];

            foreach ($incomeSourceInputs as $income_source) {
                $data = [];

                if (!is_null($seniors->id)) {
                    $data['senior_id'] = $seniors->id;
                }

                if (!is_null($income_source)) {
                    $data['income_source_id'] = $income_source;
                }

                if ($income_source == $lastIncomeSourceId
                ) {
                    $data['other_income_source_remark'] = $request->input('other_income_source_remark');
                }

                if (!empty($data)) {
                    DB::table('income_source')->insert($data);
                }
            }
        }

        foreach ($request->relative_name as $index => $name) {
            DB::table('family_composition')->insert([
                'senior_id' => $seniors->id,
                'relative_name' => $name ?: null, 
                'relative_relationship' => $request->relative_relationship[$index] ?: null,
                'relative_age' => $request->relative_age[$index] ?: null,
                'relative_civil_status' => $request->relative_civil_status[$index] ?: null,
                'relative_occupation' => $request->relative_occupation[$index] ?: null,
                'relative_income' => $request->relative_income[$index] ?: null,
            ]);
        }

        return redirect()->route('verify-email')->with([
            'email' => $seniors->email,
            'code' => $seniors->verification_code,
            'showVerificationModal' => true,
            'message' => 'Registration successful. Please verify your email.'
        ]);
    }

    public function showVerificationFormRegister()
    {
        return redirect(url()->previous())->with([
            'showVerificationModal' => true,
            'email' => session('email'),
            'code' => session('code'), 
            'message' => 'Registration successful. Please verify your email.'
        ]);
    }

    public function verifyEmailCodeRegister(Request $request)
    {

        $email = $request->input('email');
        $code = $request->input('code');

        $senior = Seniors::where('email', $email)
            ->where('verification_code', $code)
            ->first();

        if ($senior) {
            if ($senior->verification_expires_at && $senior->verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $senior->verified_at = now();
            $senior->verification_code = null;
            $senior->verification_expires_at = null;
            $senior->save();

            session()->flash('message', 'Email verified successfully.');

            return response()->json(['message' => 'Email verified successfully.', 'redirect' => url()->previous()], 200);
        }

        return response()->json(['error' => 'Invalid verification code.'], 400);
    }

    public function resendVerificationCode(Request $request)
    {
        $email = $request->input('email');

        if (empty($email)) {
            $senior = Seniors::latest()->first();
            $email = $senior?->email;
        }

        $senior = Seniors::where('email', $email)->first();

        if ($senior) {
            if ($senior->verified_at) {
                return response()->json(['error' => 'Your email is already verified.'], 200);
            }

            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $expirationTime = now()->addHour();

            $senior->verification_code = $verificationCode;
            $senior->verification_expires_at = $expirationTime;
            $senior->save();

            Mail::to($senior->email)->send(new SeniorResendCodeEmail($verificationCode, $expirationTime));

            return response()->json(['message' => 'A new verification code has been sent to your email.'], 200);
        }

        return response()->json(['error' => 'Failed to resend verification code. Please try again.'], 400);
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url()->previous())->with('message', 'Logout successful');
    }

    public function showVerificationFormLogin()
    {
        return redirect(url()->previous())->with([
            'showVerificationModal' => true,
            'clearLoginModal' => true,
            'email' => session('email'),
            'error-message' => 'Login Failed. Verify your email first.'
        ]);
    }

    public function login(Request $request)
    {
        $loginMessages = [
            'email.required' => 'Enter your email.',
            'password.required' => 'Enter your password.',
        ];

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ], $loginMessages);

        $senior_login = Seniors::where('email', $validated['email'])->first();

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

        return redirect(url()->previous())->with([
            'message' => 'Welcome back!',
            'clearLoginModal' => true, 
        ]);
    }

    public function showForgotPassword()
    {
        return redirect(url()->previous())->with([
            'showForgotPasswordModal' => true,
        ]);
    }

    public function sendEmailForReset(Request $request)
    {
        $ResetMessages = [
            'email.required' => 'Enter your email.',
        ];

        $validated = $request->validate([
            'email' => ['required', 'email'],
        ], $ResetMessages);

        $senior_reset_password = Seniors::where('email', $validated['email'])->first();

        if (!$senior_reset_password) {
            return back()->withErrors(['email' => "This email doesn't exist."])->withInput(['email' => $validated['email']]);
        }

        $token = Str::random(30);
        $expiresAt = now()->addHour();

        $senior_reset_password->update([
            'token' => $token,
            'expiration' => $expiresAt,
        ]);

        $email = $senior_reset_password->email;

        try {
            Mail::to($email)->send(new SeniorForgotPassword($token, $expiresAt, $email));

            return redirect(url()->previous())->with([
                'message' => 'Reset token has been sent to your email.',
                'clearForgotPasswordModal' => true,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset email. Please try again later.']);
        }
    }

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        $senior = Seniors::where('email', $email)->first();

        if (!$senior || is_null($senior->token) && is_null($senior->expiration)) {
            return redirect('/')->with([
                'error-message' => 'This token has been used.'
            ]);
        }

        if ($senior && $senior->expiration > now()) {
            return redirect()->to('/?token=' . urlencode($token) . '&email=' . urlencode($email))->with([
                'showPasswordResetModal' => true,
                'savePasswordResetModal' => true,
                'token' => $token,
                'email' => $email
            ]);
        } else {
            return redirect('/')->with([
                'error-message' => 'Your token has expired. Request for reset link again.'
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:seniors,email',
            'password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
            ],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Provide a valid email address.',
            'email.exists' => 'This email is not registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 32 characters.',
            'password.regex' => 'Include at least one uppercase letter, one lowercase letter, and one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $senior = Seniors::where('email', $request->input('email'))->first();
        if ($senior) {
            $senior->password = bcrypt($request->input('password'));
            $senior->token = null;
            $senior->expiration = null;
            $senior->save();

            return redirect('/')->with('message', 'Your password has been reset successfully.');
        }

        return redirect('/')->with([
            'savePasswordResetModal' => true,
            'error-message' => 'An error occurred while resetting your password. Please try again.'
        ]);
    }

}
