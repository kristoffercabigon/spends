<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; 
use App\Mail\SeniorResendCodeEmail;
use App\Mail\SeniorVerificationEmail;
use App\Mail\SeniorLoginAttempt;
use App\Mail\SeniorForgotPassword;
use App\Mail\SeniorReferenceNumber;
use App\Mail\SeniorPasswordChangeVerificationCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\StoreSeniorRequest;
use Illuminate\Support\Facades\Facade;

class SeniorsController extends Controller
{
    public function index()
    {
        $data = [
            "seniors" => DB::table('seniors')->orderBy('created_at', 'desc')->paginate(10)
        ];

        return view('senior_citizen.index', $data)->with('title', 'Home ');
    }

    public function announcements()
    {
        $currentMonth = now()->format('Y-m');
        $barangayList = DB::table('barangay_list')->get();

        $availableMonths = DB::table('pension_distribution_list')
        ->selectRaw('DISTINCT DATE_FORMAT(date_of_distribution, "%Y-%m") as month')
        ->orderByDesc('month')  
        ->get();

        $pension_distributions = DB::table('pension_distribution_list')
        ->leftJoin('barangay_list', 'pension_distribution_list.barangay_id', '=', 'barangay_list.id')
        ->select(
            'pension_distribution_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no'
        )
            ->where('pension_distribution_list.date_of_distribution', 'LIKE', "$currentMonth%")
            ->orderBy('pension_distribution_list.date_of_distribution', 'asc')
            ->paginate(10);

        $featured_events = DB::table('events_list')
        ->leftJoin('barangay_list', 'events_list.barangay_id', '=', 'barangay_list.id')
        ->leftJoin('user_type_list', 'events_list.event_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'events_list.event_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'events_list.event_admin_id', '=', 'admin.id')
        ->leftJoin('events_images', 'events_list.id', '=', 'events_images.event_id')
        ->select(
            'events_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no',
            'encoder.encoder_first_name',
            'encoder.encoder_last_name',
            'encoder_profile_picture',
            'admin.admin_first_name',
            'admin.admin_last_name',
            'admin_profile_picture',
            'user_type_list.user_type',
            'events_images.image',
            'events_images.is_highlighted'
        )
        ->where('events_list.is_featured', '=', 1)
        ->where('events_images.is_highlighted', '=', 1)
        ->orderBy('events_list.id', 'asc')
        ->paginate(10);

        $events = DB::table('events_list')
        ->leftJoin('barangay_list', 'events_list.barangay_id', '=', 'barangay_list.id')
        ->leftJoin('user_type_list', 'events_list.event_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'events_list.event_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'events_list.event_admin_id', '=', 'admin.id')
        ->leftJoin('events_images', 'events_list.id', '=', 'events_images.event_id')
        ->select(
            'events_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no',
            'encoder.encoder_first_name',
            'encoder.encoder_last_name',
            'encoder_profile_picture',
            'admin.admin_first_name',
            'admin.admin_last_name',
            'admin_profile_picture',
            'user_type_list.user_type',
            'events_images.image',
            'events_images.is_highlighted'
        )
            ->where('events_images.is_highlighted', '=', 1)
            ->orderBy('events_list.id', 'asc')
            ->paginate(10);

        return view('senior_citizen.announcements', [
            'title' => 'Announcement',
            'featured_events' => $featured_events,
            'events' => $events,
            'barangayList' => $barangayList,
            'pension_distributions' => $pension_distributions,
            'availableMonths' => $availableMonths, 
        ]);
    }

    public function filterAnnouncements(Request $request)
    {
        $monthId = $request->input('month_id');
        $perPage = 10;

        $query = DB::table('pension_distribution_list')
        ->leftJoin('barangay_list', 'pension_distribution_list.barangay_id', '=', 'barangay_list.id')
        ->select(
            'pension_distribution_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no'
        );

        if (!empty($monthId)) {
            $query->where('pension_distribution_list.date_of_distribution', 'LIKE', "$monthId%");
        }

        $query->orderBy('pension_distribution_list.date_of_distribution', 'asc');

        $pension_distributions = $query->paginate($perPage);

        return response()->json($pension_distributions);
    }

    public function contact_us()
    {
        return view('senior_citizen.contact_us')->with('title', 'Contact Us ');
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

    public function about_us()
    {
        return view('senior_citizen.about_us')->with('title', 'About Us ');
    }

    public function track_request(Request $request)
    {
        $senior_application_status_list = DB::table('senior_application_status_list')->get();

        $validated = $request->validate([
            'ncsc_rrn' => 'required|max:255',
        ], [
            'ncsc_rrn.required' => 'Reference number is required.'
        ]);

        $senior = Seniors::where('ncsc_rrn', $validated['ncsc_rrn'])->first();

        if ($senior) {
            
            return redirect()->back()->with([
                'clearRequestTrackerModal' => true,
                'showRequestStatusModal' => true,
                'senior_application_status_list' => $senior_application_status_list,
                'seniorApplicationStatus' => $senior->application_status_id,
            ]);
        } else {
            return redirect()->back()->withErrors([
                'ncsc_rrn' => 'The reference number does not exist in our records.',
            ]);
        }
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
        $relationship_list = DB::table('relationship_list')->get();
        $barangay = DB::table('barangay_list')->get();

        return view('senior_citizen.create')->with([
            'title' => 'Register',
            'income_sources' => $income_sources,
            'incomes' => $incomes,
            'pensions' => $pensions,
            'sources' => $sources,
            'arrangement_lists' => $arrangement_lists,
            'sexes' => $sexes,
            'civil_status_list' => $civil_status_list,
            'relationship_list' => $relationship_list,
            'barangay' => $barangay
        ]);
    }

    public function store(StoreSeniorRequest $request)
    {
        //dd($request->all());

        $validated = $request->validated();

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($seniorData['income_source'], $seniorData['other_income_source_remark']);
        unset($seniorData['confirm-checkbox']);
        unset($seniorData['g-recaptcha-response']);

        do {
            $osca_id = rand(10000, 99999);
        } while (DB::table('seniors')->where('osca_id', $osca_id)->exists());

        $user_type_id = 1;
        $application_status_id = 1;
        $account_status_id = null;
        $date_approved = null;

        $seniorData['registration_assistant_id'] = null;
        $seniorData['registration_assistant_name'] = null;
        $seniorData['application_assistant_id'] = null;
        $seniorData['application_assistant_name'] = null;

        $seniorData['date_applied'] = now();
        $seniorData['osca_id'] = $osca_id;

        $ncsc_rrn = $seniorData['date_applied']->format('Ymd') . '-' . $osca_id;

        $seniorData['ncsc_rrn'] = $ncsc_rrn;

        $seniorData['user_type_id'] = $user_type_id;
        $seniorData['application_status_id'] = $application_status_id;
        $seniorData['account_status_id'] = $account_status_id;
        $seniorData['date_approved'] = $date_approved;

        if (empty($request->input('g-recaptcha-response'))) {
            $seniorData['g-recaptcha-response'] = 'The ReCaptcha field is required.';
        }

        if ($request->hasFile('valid_id')) {
            $validIdFilename = $osca_id;
            $validIdExtension = $request->file('valid_id')->getClientOriginalExtension();
            $validIdFilenameToStore = $validIdFilename . '.' . $validIdExtension;

            $request->file('valid_id')->storeAs('images/senior_citizen/valid_id', $validIdFilenameToStore);
            $seniorData['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096',
            ]);

            $profilePictureFilename = $osca_id; 
            $profilePictureExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $profilePictureFilenameToStore = $profilePictureFilename . '.' . $profilePictureExtension;

            $request->file('profile_picture')->storeAs('images/senior_citizen/profile_picture', $profilePictureFilenameToStore);
            $seniorData['profile_picture'] = $profilePictureFilenameToStore;

            $thumbnailFilename = $profilePictureFilename . '.' . $profilePictureExtension;
            $thumbnailPath = 'storage/images/senior_citizen/thumbnail_profile/' . $thumbnailFilename;

            $request->file('profile_picture')->storeAs('images/senior_citizen/thumbnail_profile', $thumbnailFilename);

            $this->createThumbnail(public_path('storage/images/senior_citizen/profile_picture/' . $profilePictureFilenameToStore), public_path($thumbnailPath), 150, 150);
        }

        if ($request->hasFile('indigency')) {
            $indigencyFilename = $osca_id; 
            $indigencyExtension = $request->file('indigency')->getClientOriginalExtension();
            $indigencyFilenameToStore = $indigencyFilename . '.' . $indigencyExtension;
            $request->file('indigency')->storeAs('images/senior_citizen/indigency', $indigencyFilenameToStore);
            $seniorData['indigency'] = $indigencyFilenameToStore;
        }

        if ($request->hasFile('birth_certificate')) {
            $birthCertificateFilename = $osca_id;
            $birthCertificateExtension = $request->file('birth_certificate')->getClientOriginalExtension();
            $birthCertificateFilenameToStore = $birthCertificateFilename . '.' . $birthCertificateExtension;

            $request->file('birth_certificate')->storeAs('images/senior_citizen/birth_certificate', $birthCertificateFilenameToStore);
            $seniorData['birth_certificate'] = $birthCertificateFilenameToStore;
        }

        if ($request->has('signature_data')) {
            $signatureData = $request->input('signature_data');

            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFilename = $osca_id . '.png';
            $path = storage_path('app/public/images/senior_citizen/signatures/');
            file_put_contents($path . $signatureFilename, $signatureData);

            $seniorData['signature_data'] = $signatureFilename;
        }

        $seniorData['contact_no'] = '+63' . $seniorData['contact_no'];

        $seniorData['password'] = Hash::make($seniorData['password']);

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedVerificationCode = Hash::make($verificationCode);

        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $seniorData['verification_code'] = $hashedVerificationCode;
        $seniorData['verification_expires_at'] = $expirationTime;

        $seniors = Seniors::create($seniorData);

        Mail::to($seniorData['email'])->send(new SeniorVerificationEmail($verificationCode, $expirationTime));
        Mail::to($seniorData['email'])->send(new SeniorReferenceNumber($ncsc_rrn));

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

        if ($request->guardian_first_name || $request->guardian_last_name) {
            DB::table('senior_guardian')->insert([
                'senior_id' => $seniors->id,
                'guardian_first_name' => $request->guardian_first_name ?: null,
                'guardian_middle_name' => $request->guardian_middle_name ?: null,
                'guardian_last_name' => $request->guardian_last_name ?: null,
                'guardian_suffix' => $request->guardian_suffix ?: null,
                'guardian_relationship_id' => $request->guardian_relationship_id ?: null,
                'guardian_contact_no' => $request->guardian_contact_no ? '+63' . ltrim($request->guardian_contact_no, '0') : null,
            ]);
        }

        foreach ($request->relative_name as $index => $name) {
            if (!empty($name)) {
                DB::table('family_composition')->insert([
                    'senior_id' => $seniors->id,
                    'relative_name' => $name,
                    'relative_relationship_id' => $request->relative_relationship_id[$index] ?? null,
                    'relative_age' => $request->relative_age[$index] ?? null,
                    'relative_civil_status_id' => $request->relative_civil_status_id[$index] ?? null,
                    'relative_occupation' => $request->relative_occupation[$index] ?? null,
                    'relative_income' => $request->relative_income[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('verify-email')->with([
            'email' => $seniors->email,
            'code' => $seniors->verification_code,
            'showVerificationModal' => true,
            'message-header' => 'Registration successful',
            'message-body' => 'Please verify your email.'
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
        if (!session()->has('email')) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect(url()->previous())->with([
            'showVerificationModal' => true,
            'email' => session('email'),
            'code' => session('code'),
            'message-header' => 'Registration successful',
            'message-body' => 'Please verify your email.'
        ]);
    }

    public function verifyEmailCodeRegister(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');

        $senior = Seniors::where('email', $email)->first();

        if ($senior && Hash::check($code, $senior->verification_code)) {

            if ($senior->verification_expires_at && $senior->verification_expires_at->isPast()) {
                return response()->json(['error' => 'Verification code has expired. Please request a new one.'], 400);
            }

            $senior->verified_at = now();
            $senior->verification_code = null;
            $senior->verification_expires_at = null;
            $senior->save();

            session()->flash('message-header', 'Success');
            session()->flash('message-body', 'Email verified successfully.');

            session(['showLoginModal' => true]);

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
            $hashedVerificationCode = Hash::make($verificationCode);

            $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

            $senior->verification_code = $hashedVerificationCode;
            $senior->verification_expires_at = $expirationTime;
            $senior->save();

            Mail::to($senior->email)->send(new SeniorResendCodeEmail($verificationCode, $expirationTime));

            return response()->json(['message' => 'A new verification code has been sent to your email.'], 200);
        }

        return response()->json(['error' => 'Failed to resend verification code. Please try again.'], 400);
    }

    public function logout(Request $request)
    {
        FacadesAuth::guard('senior')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with([
            'message-header'=> 'Success',
            'message-body' => 'Successfully logged out.'
        ]);
    }

    public function showVerificationFormLogin()
    {
        if (!session()->has('email')) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect(url()->previous())->with([
            'showVerificationModal' => true,
            'clearLoginModal' => true,
            'email' => session('email'),
            'error-message-header' => 'Login Failed',
            'error-message-body' => 'Verify your email first.'
        ]);
    }

    public function showSignatureUpdateModal()
    {
        if (!session()->has('email')) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Restricted Access.',
            ]);
        }

        return redirect()->to(url()->previous() . '?email=' . urlencode(session('email')))->with([
            'showSignatureModal' => true,
            'clearLoginModal' => true,
            'email' => session('email'),
            'error-message-header' => 'Login Failed',
            'error-message-body' => 'Write your signature first.'
        ]);
    }

    public function submitSignatureUpdateModal(Request $request)
    {
        if (!$request->has('signature_data1') || empty($request->signature_data1)) {
            return back()->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Please provide your signature.',
            ]);
        }

        $email = $request->input('email', session('email'));
        $signatureData = $request->input('signature_data1');

        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureData = base64_decode($signatureData);

        $senior = Seniors::where('email', $email)->first();

        if ($senior) {
            $osca_id = $senior->osca_id;
            $signatureFilename = $osca_id . '.png';
            $path = storage_path('app/public/images/senior_citizen/signatures/');
            file_put_contents($path . $signatureFilename, $signatureData);

            $senior->signature_data = $signatureFilename;
            $senior->save();
        }

        return back()->with([
            'message-header' => 'Success',
            'message-body' => 'Signature has been updated successfully.',
            'clearSignatureModal' => true,
            'showLoginModal' => true,
        ]);
    }

    public function login(Request $request)
    {
        $loginMessages = [
            'email.required' => 'Enter your email.',
            'password.required' => 'Enter your password.',
            'g-recaptcha-response' => 'Recaptcha field is required',
        ];

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) use ($request) {
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

        $email = $validated['email'];
        $throttleTime = Carbon::now()->format('Y-m-d H:i:s');

        $senior_login = Seniors::where('email', $email)->first();

        $seniorUserTypeId = $senior_login ? $senior_login->user_type_id : null;

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            DB::table('user_login_attempts')->insert([
                'email' => $email,
                'status' => 'Throttled',
                'user_type_id' => $seniorUserTypeId,
                'created_at' => now(),
            ]);

            Mail::to($email)->send(new SeniorLoginAttempt($email, $throttleTime));

            return redirect('/')->with([
                'error-message-header' => 'Too many attempts',
                'error-message-body' => 'Please try again after 5 minutes.',
            ]);
        }

        if (!$senior_login) {
            DB::table('user_login_attempts')->insert([
                'email' => $email,
                'status' => 'Failed',
                'user_type_id' => $seniorUserTypeId,
                'created_at' => now(),
            ]);

            return back()->withErrors(['email' => "This email doesn't exist."])->onlyInput('email');
        }

        if (is_null($senior_login->verified_at)) {
            return redirect()->route('verify-email-login')->with([
                'email' => $senior_login->email,
                'showVerificationModal' => true,
                'clearLoginModal' => true,
                'error-message-header' => 'Login Failed',
                'error-message-body' => 'Verify your email first.',
            ]);
        }

        if (is_null($senior_login->signature_data)) {
            return redirect()->route('update-signature')->with([
                'email' => $senior_login->email,
                'showSignatureModal' => true,
                'clearLoginModal' => true,
                'error-message-header' => 'Signature Required',
                'error-message-body' => 'Please provide your e-signature to continue.',
            ]);
        }

        // if ($senior_login->application_status_id !== 3) {
        //     return back()->with([
        //         'error-message-header' => 'Login Failed',
        //         'error-message-body' => 'Your account is not approved yet.',
        //     ])->onlyInput('email');
        // }

        if (!Hash::check($validated['password'], $senior_login->password)) {
            DB::table('user_login_attempts')->insert([
                'email' => $email,
                'status' => 'Failed',
                'user_type_id' => $seniorUserTypeId,
                'created_at' => now(),
            ]);

            RateLimiter::hit($this->throttleKey($request), 300);

            return back()->withErrors(['password' => 'Password incorrect.'])->onlyInput('email');
        }

        $remember = $request->has('remember');

        FacadesAuth::guard('senior')->login($senior_login, $remember);
        $request->session()->regenerate();
        $request->session()->put('senior', $senior_login);

        DB::table('user_login_attempts')->insert([
            'email' => $email,
            'status' => 'Successful',
            'user_type_id' => $seniorUserTypeId,
            'created_at' => now(),
        ]);

        return redirect('/')->with([
            'message-header' => 'Welcome back!',
            'message-body' => 'Successfully logged in.',
            'clearLoginModal' => true,
        ]);
    }

    public function throttleKey(Request $request)
    {
        return 'login:' . $request->input('email');
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
        $expiresAt = now()->addHour()->setTimezone('Asia/Manila');

        $senior_reset_password->update([
            'token' => $token,
            'expiration' => $expiresAt,
        ]);

        $email = $senior_reset_password->email;

        try {
            Mail::to($email)->send(new SeniorForgotPassword($token, $expiresAt, $email));

            return redirect(url()->previous())->with([
                'message-header' => 'Success',
                'message-body' => 'Reset token has been sent to your email.',
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

        if (!$senior) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Restricted Access.',
                'removePasswordResetModal' => true
            ]);
        }

        if (is_null($senior->token) || is_null($senior->expiration)) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'This token has been used.',
                'removePasswordResetModal' => true
            ]);
        }

        if ($senior->expiration <= now()) {
            return redirect('/')->with([
                'error-message-header' => 'Failed',
                'error-message-body' => 'Your token has expired. Request for reset link again.',
                'removePasswordResetModal' => true
            ]);
        }

        return redirect()->to('/?token=' . urlencode($token) . '&email=' . urlencode($email))->with([
            'showPasswordResetModal' => true,
            'savePasswordResetModal' => true,
            'token' => $token,
            'email' => $email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:seniors,email',
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
            'password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('email', $request->input('email'));
        }

        $senior = Seniors::where('email', $request->input('email'))->first();

        if ($senior) {
            $senior->password = bcrypt($request->input('password'));
            $senior->token = null;
            $senior->expiration = null;
            $senior->save();

            return redirect('/')->with([
                'message-header' => 'Success',
                'message-body' => 'Your password has been reset successfully.',
                'removePasswordResetModal' => true
            ]);
        }

        return redirect()->route('reset-password')->with([
            'savePasswordResetModal' => true,
            'email' => $request->input('email'),
            'token' => $request->input('token'),
            'error-message-header' => 'Failed',
            'error-message-body' => 'An error occurred while resetting your password. Please try again.'
        ]);
    }

    public function showSeniorProfile($senior_id)
    {
        $senior = Seniors::findOrFail($senior_id);

        $sex_list = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $barangay_list = DB::table('barangay_list')->get();
        $senior_account_status_list = DB::table('senior_account_status_list')->get();
        $senior_application_status_list = DB::table('senior_application_status_list')->get();

        $selectedAccount_Status = $senior_account_status_list->firstWhere('id', $senior->account_status_id);
        $selectedApplication_Status = $senior_application_status_list->firstWhere('id', $senior->application_status_id);

        return view('senior_citizen.profile', [
            'senior' => $senior,
            'title' => 'Profile',
            'sex' => $sex_list,
            'civil_status' => $civil_status_list,
            'barangay' => $barangay_list,
            'account_status' => $selectedAccount_Status,
            'application_status' => $selectedApplication_Status,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:seniors,email',
            'old_password' => 'required',
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
            'password' => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    $senior = Seniors::where('email', $request->email)->first();
                    if (Hash::check($value, $senior->password)) {
                        $fail('The new password must not be the same as the old password.');
                    }
                },
            ],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Provide a valid email address.',
            'email.exists' => 'This email is not registered.',
            'old_password.required' => 'Current Password is required',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 32 characters.',
            'password.regex' => 'Include uppercase, lowercase letter and symbol.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $senior = Seniors::where('email', $request->email)->first();

        if (!Hash::check($request->old_password, $senior->password)) {
            return back()->withErrors(['old_password' => 'The current password is incorrect.']);
        }

        $change_password_verification_code = rand(100000, 999999);
        session([
            'change_password_verification_code' => $change_password_verification_code,
            'password' => $request->password,
            'email' => $request->email,
        ]);

        Mail::to($senior->email)->send(new SeniorPasswordChangeVerificationCode($change_password_verification_code));

        session()->flash('showChangePasswordEmailVerifyModal', true);

        return redirect()->back()->with([
            'message-header' => 'Success',
            'message-body' => 'A verification code has been sent to your email.'
        ]);
    }

    public function verifyChangePasswordCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        if ($request->verification_code != session('change_password_verification_code')) {
            return back()->withErrors(['verification_code' => 'The verification code is incorrect.']);
        }

        $senior = Seniors::where('email', session('email'))->first();

        if (!$senior) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        $senior->password = Hash::make(session('password'));
        $senior->save();

        session()->forget('change_password_verification_code');
        session()->forget('password');
        session()->flash('clearChangePasswordEmailVerifyModal', true);
        session()->flash('clearChangePasswordModal', true);

        return redirect()->back()->with([
            'message-header' => 'Success',
            'message-body'=> 'Password changed successfully.'
        ]);
    }

}
