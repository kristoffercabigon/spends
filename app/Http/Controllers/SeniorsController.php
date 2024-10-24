<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; 
use App\Mail\VerificationEmail; 
use Illuminate\Support\Str;

class SeniorsController extends Controller
{
    public function index()
    {
        $data = array("seniors" => DB::table('seniors')->orderBy('created_at', 'desc')->paginate(10));
        return view('seniors.index', $data)->with('title', 'SPENDS: Home ');
    }

    public function create()
    {
        $sources = DB::table('source_list')->get();
        $arrangement_lists = DB::table('living_arrangement_list')->get();
        $sexes = DB::table('sex')->get();
        $civil_status = DB::table('civil_status')->get();
        $barangay = DB::table('barangay')->get();

        return view('seniors.create')->with([
            'title' => 'SPENDS: Register',
            'sources' => $sources,
            'arrangement_lists' => $arrangement_lists,
            'sexes' => $sexes,
            'civil_status' => $civil_status,
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
            'address.min' => 'Address must be at least 20 characters.',
            'address.max' => 'Address cannot exceed 100 characters.',
            'barangay_id.required' => 'Barangay is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 32 characters.',
            'password.regex' => 'Include 1 uppercase letter and 1 special character.',
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
            'source.required_if' => 'Source of income is required if you are a pensioner.',
            'source.*.required_if' => 'Each source of income is required if you are a pensioner.',
            'other_source_remark.required_if' => 'This field is required if the source is "Other".',
            'permanent_source.required' => 'Permanent source of income is required.',
            'if_permanent_yes.required_if' => 'This field is required if the permanent source is "Yes".',
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
            "if_permanent_yes" => 'required_if:permanent_source,1',
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

        if (empty($request->input('g-recaptcha-response'))) {
            $validated['g-recaptcha-response'] = 'The ReCaptcha field is required.';
        }

        if ($request->hasFile('valid_id')) {
            $validIdFilename = pathinfo($request->file('valid_id')->getClientOriginalName(), PATHINFO_FILENAME);
            $validIdExtension = $request->file('valid_id')->getClientOriginalExtension();
            $validIdFilenameToStore = $validIdFilename . '_' . time() . '.' . $validIdExtension;

            $request->file('valid_id')->storeAs('images/valid_id', $validIdFilenameToStore);
            $validated['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $profilePictureFilename = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
            $profilePictureExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $profilePictureFilenameToStore = $profilePictureFilename . '_' . time() . '.' . $profilePictureExtension;

            $request->file('profile_picture')->storeAs('images/profile_picture', $profilePictureFilenameToStore);
            $validated['profile_picture'] = $profilePictureFilenameToStore;
        }

        if ($request->hasFile('indigency')) {
            $indigencyFilename = pathinfo($request->file('indigency')->getClientOriginalName(), PATHINFO_FILENAME);
            $indigencyExtension = $request->file('indigency')->getClientOriginalExtension();
            $indigencyFilenameToStore = $indigencyFilename . '_' . time() . '.' . $indigencyExtension;

            $request->file('indigency')->storeAs('images/indigency', $indigencyFilenameToStore);
            $validated['indigency'] = $indigencyFilenameToStore;
        }

        if ($request->hasFile('birth_certificate')) {
            $birthCertificateFilename = pathinfo($request->file('birth_certificate')->getClientOriginalName(), PATHINFO_FILENAME);
            $birthCertificateExtension = $request->file('birth_certificate')->getClientOriginalExtension();
            $birthCertificateFilenameToStore = $birthCertificateFilename . '_' . time() . '.' . $birthCertificateExtension;

            $request->file('birth_certificate')->storeAs('images/birth_certificate', $birthCertificateFilenameToStore);
            $validated['birth_certificate'] = $birthCertificateFilenameToStore;
        }

        if ($request->has('signature_data')) {
            $signatureData = $request->input('signature_data');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = base64_decode($signatureData);
            $signatureFilename = 'signature_' . time() . '.png';
            $path = storage_path('app/public/images/signatures/');
            file_put_contents($path . $signatureFilename, $signatureData);
            $validated['signature_data'] = $signatureFilename;
        }

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($validated['g-recaptcha-response']);

        $seniorData['password'] = Hash::make($seniorData['password']);

        $seniorData['date_applied'] = now();

        $seniorData['verification_code'] = Str::random(30);

        $seniors = Seniors::create($seniorData);

        Mail::to($seniorData['email'])->send(new VerificationEmail($seniors->verification_code));

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

                if ($source == 4) {
                    $data['other_source_remark'] = $request->input('other_source_remark');
                }

                if (!empty($data)) {
                    DB::table('source')->insert($data);
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

        return redirect('/')->with('message', 'Registration Successful');
    }

    public function verifyEmail(Request $request)
    {
        $senior = Seniors::where('verification_code', $request->input('code'))->first();

        if ($senior) {
            $senior->verified_at = now();
            $senior->verification_code = null;
            $senior->save();

            return redirect('/')->with('message', 'Email verified successfully.');
        }

        return redirect('/')->with('error', 'Invalid verification code.');
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout successful');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            "password" => 'required'
        ]);

        if (FacadesAuth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }
}
