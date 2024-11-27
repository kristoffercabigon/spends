<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Seniors;
use App\Models\Encoder;
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
use App\Mail\SeniorReferenceNumber;
use App\Mail\SeniorRegisteredByStaff;
use App\Mail\SeniorChangedEmail;
use App\Http\Requests\StoreAddBeneficiary;
use App\Http\Requests\UpdateEditBeneficiary;
use App\Mail\SeniorPassword;
use App\Mail\EncoderVerificationEmail;
use App\Mail\EncoderPassword;
use App\Http\Requests\StoreEncoderRequest;

class AdminController extends Controller
{
    public function showAdminIndex()
    {
        return view('admin.admin_index')->with('title', 'Home ');
    }

    public function about_us()
    {
        return view('admin.admin_about_us')->with('title', 'About Us ');
    }

    public function showAdminDashboard()
    {
        return view('admin.admin_dashboard', [
            'title' => 'Admin Dashboard'
        ]);
    }

    public function showAdminApplicationRequests()
    {
        $seniors = DB::table('seniors')
        ->leftJoin('sex_list', 'seniors.sex_id', '=', 'sex_list.id')
        ->leftJoin('senior_application_status_list', 'seniors.application_status_id', '=', 'senior_application_status_list.id')
        ->leftJoin('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
        ->select(
            'seniors.*',
            'sex_list.sex as sex_name',
            'senior_application_status_list.senior_application_status as senior_application_status',
            'barangay_list.barangay_no as barangay_no'
        )
            ->orderBy('seniors.id', 'asc')
            ->paginate(10);

        $applicationStatuses = DB::table('senior_application_status_list')->get();
        $barangayList = DB::table('barangay_list')->get();

        return view('admin.admin_application_requests', [
            'title' => 'Application Requests',
            'seniors' => $seniors,
            'applicationStatuses' => $applicationStatuses,
            'barangayList' => $barangayList,
        ]);
    }

    public function filterSeniorsApplicationRequests(Request $request)
    {
        $barangayId = $request->input('barangay_id');
        $statusIds = $request->input('status_ids', []);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchQuery = $request->input('search_query', '');
        $orderDirection = $request->input('order', 'asc'); 
        $perPage = 10;

        $query = DB::table('seniors')
        ->leftJoin('sex_list', 'seniors.sex_id', '=', 'sex_list.id')
        ->leftJoin('senior_application_status_list', 'seniors.application_status_id', '=', 'senior_application_status_list.id')
        ->leftJoin('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
        ->select(
            'seniors.*',
            'sex_list.sex as sex_name',
            'senior_application_status_list.senior_application_status as senior_application_status',
            'barangay_list.barangay_no as barangay_no'
        );

        if (!empty($barangayId)) {
            $query->where('seniors.barangay_id', $barangayId);
        }

        if (!empty($statusIds)) {
            $query->whereIn('seniors.application_status_id', $statusIds);
        }

        if ($startDate) {
            $query->whereDate('seniors.date_applied', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('seniors.date_applied', '<=', $endDate);
        }

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(CONCAT_WS(' ', seniors.first_name, seniors.middle_name, seniors.last_name, seniors.suffix)) LIKE ?", ['%' . $term . '%']);
                }
            })->orWhere('seniors.osca_id', 'LIKE', '%' . $searchQuery . '%');
        }

        if ($startDate || $endDate) {
            $query->orderBy('seniors.date_applied', $orderDirection);
        } else {
            $query->orderBy('seniors.id', $orderDirection);
        }

        $seniors = $query->paginate($perPage);

        return response()->json($seniors);
    }

    public function showAdminSeniorProfile($id)
    {
        $seniors = Seniors::findOrFail($id);

        $sex_list = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $barangay_list = DB::table('barangay_list')->get();
        $user_type_list = DB::table('user_type_list')->get();
        $living_arrangement_list = DB::table('living_arrangement_list')->get();
        $how_much_pension_list = DB::table('how_much_pension_list')->get();
        $how_much_income_list = DB::table('how_much_income_list')->get();
        $senior_account_status_list = DB::table('senior_account_status_list')->get();
        $senior_application_status_list = DB::table('senior_application_status_list')->get();

        $family_composition = DB::table('family_composition')
        ->leftJoin('seniors', 'family_composition.senior_id', '=', 'seniors.id')
        ->leftJoin('civil_status_list', 'family_composition.relative_civil_status_id', '=', 'civil_status_list.id')
        ->leftJoin('relationship_list', 'family_composition.relative_relationship_id', '=', 'relationship_list.id')
        ->where('seniors.id', $id)
            ->select('family_composition.*', 'civil_status_list.civil_status', 'relationship_list.relationship')
            ->get();

        $senior_guardian = DB::table('senior_guardian')
        ->leftJoin('seniors', 'senior_guardian.senior_id', '=', 'seniors.id')
        ->leftJoin('relationship_list', 'senior_guardian.guardian_relationship_id', '=', 'relationship_list.id')
        ->where('seniors.id', $id)
            ->select('senior_guardian.*', 'relationship_list.relationship')
            ->first();

        $sources = DB::table('source')
        ->leftJoin('seniors', 'source.senior_id', '=', 'seniors.id')
        ->leftJoin('source_list', 'source.source_id', '=', 'source_list.id')
        ->where('seniors.id', $id)
            ->select('source.*', 'source_list.source_list', 'source.other_source_remark')
            ->get();

        $income_sources = DB::table('income_source')
        ->leftJoin('seniors', 'income_source.senior_id', '=', 'seniors.id')
        ->leftJoin('where_income_source_list', 'income_source.income_source_id', '=', 'where_income_source_list.id')
        ->where('seniors.id', $id)
            ->select('income_source.*', 'where_income_source_list.where_income_source', 'income_source.other_income_source_remark')
            ->get();

        $adminId = auth()->guard('admin')->id();

        $selectedSex = $sex_list->firstWhere('id', $seniors->sex_id);
        $selectedBarangay = $barangay_list->firstWhere('id', $seniors->barangay_id);
        $selectedApplicationAssistant = $user_type_list->firstWhere('id', $seniors->application_assistant_id);
        $selectedRegistrationAssistant = $user_type_list->firstWhere('id', $seniors->registration_assistant_id);
        $selectedCivil_Status = $civil_status_list->firstWhere('id', $seniors->civil_status_id);
        $selectedLiving_Arrangement = $living_arrangement_list->firstWhere('id', $seniors->type_of_living_arrangement);
        $selectedPension_Amount = $how_much_pension_list->firstWhere('id', $seniors->if_pensioner_yes);
        $selectedIncome_Amount = $how_much_income_list->firstWhere('id', $seniors->if_permanent_yes_income);
        $selectedAccount_Status = $senior_account_status_list->firstWhere('id', $seniors->account_status_id);
        $selectedApplication_Status = $senior_application_status_list->firstWhere('id', $seniors->application_status_id);

        $lastLivingArrangementId = $living_arrangement_list->last()->id ?? null;

        return view('admin.admin_senior_profile', [
            'senior' => $seniors,
            'title' => 'Profile: ' . $seniors->first_name . ' ' . $seniors->last_name,
            'sex' => $selectedSex,
            'civil_status' => $selectedCivil_Status,
            'barangay' => $selectedBarangay,
            'living_arrangement' => $selectedLiving_Arrangement,
            'lastLivingArrangementId' => $lastLivingArrangementId,
            'family_composition' => $family_composition,
            'senior_guardian' => $senior_guardian,
            'pension_amount' => $selectedPension_Amount,
            'income_amount' => $selectedIncome_Amount,
            'source' => $sources,
            'income_source' => $income_sources,
            'account_status' => $selectedAccount_Status,
            'senior_account_status_list' => $senior_account_status_list,
            'application_status' => $selectedApplication_Status,
            'senior_application_status_list' => $senior_application_status_list,
            'application_assistant' => $selectedApplicationAssistant,
            'registration_assistant' => $selectedRegistrationAssistant,
            'adminId' => $adminId,
        ]);
    }

    public function updateAdminSeniorApplicationStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|exists:senior_application_status_list,id',
        ]);

        $adminUser = auth()->guard('admin')->user();
        $adminUserTypeId = $adminUser->admin_user_type_id;
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $senior = Seniors::findOrFail($id);

        if ($senior->application_status_id == $validated['status']) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Update Unsuccessful',
                'admin-error-message-body' => 'No changes were detected in the application status.',
            ]);
        }

        if ($senior->application_status_id == 3 && $validated['status'] != 3) {
            $senior->account_status_id = null;
            $senior->application_assistant_id = null;
            $senior->application_assistant_name = null;
            $senior->date_approved = null;
        }

        $senior->application_status_id = $validated['status'];

        if ($validated['status'] == 3) {
            $senior->account_status_id = 1;
            $senior->date_approved = now();
            $senior->application_assistant_id = $adminUserTypeId;
            $senior->application_assistant_name = "{$adminFirstName} {$adminLastName}";
        }

        $senior->save();

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Application status updated successfully.',
        ]);
    }

    public function updateAdminSeniorAccountStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'account_status' => 'required|exists:senior_application_status_list,id',
        ]);

        $senior = Seniors::findOrFail($id);

        if ($senior->account_status_id == $validated['account_status']) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Update Unsuccessful',
                'admin-error-message-body' => 'No changes were detected in the application status.',
            ]);
        }

        if ($senior->application_status_id != 3) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Update Unsuccessful',
                'admin-error-message-body' => 'This user is not approved yet.',
            ]);
        }

        $senior->account_status_id = $validated['account_status'];

        $senior->save();

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Account status updated successfully.',
        ]);
    }

    public function showAdminBeneficiariesList()
    {
        $seniors = DB::table('seniors')
        ->leftJoin('sex_list', 'seniors.sex_id', '=', 'sex_list.id')
        ->leftJoin('senior_account_status_list', 'seniors.account_status_id', '=', 'senior_account_status_list.id')
        ->leftJoin('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
        ->select(
            'seniors.*',
            'sex_list.sex as sex_name',
            'senior_account_status_list.senior_account_status as senior_account_status',
            'barangay_list.barangay_no as barangay_no'
        )
            ->whereNotNull('seniors.account_status_id')
            ->orderBy('seniors.id', 'asc')
            ->paginate(10);

        $accountStatuses = DB::table('senior_account_status_list')->get();
        $barangayList = DB::table('barangay_list')->get();

        return view('admin.admin_beneficiaries_list', [
            'title' => 'Beneficiaries List',
            'seniors' => $seniors,
            'accountStatuses' => $accountStatuses,
            'barangayList' => $barangayList,
        ]);
    }

    public function filterSeniorsBeneficiaries(Request $request)
    {
        $barangayId = $request->input('barangay_id');
        $statusIds = $request->input('status_ids', []);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchQuery = $request->input('search_query', '');
        $order = $request->input('order', 'asc');
        $perPage = 10;

        $query = DB::table('seniors')
        ->leftJoin('sex_list', 'seniors.sex_id', '=', 'sex_list.id')
        ->leftJoin('senior_account_status_list', 'seniors.account_status_id', '=', 'senior_account_status_list.id')
        ->leftJoin('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
        ->select(
            'seniors.*',
            'sex_list.sex as sex_name',
            'senior_account_status_list.senior_account_status as senior_account_status',
            'barangay_list.barangay_no as barangay_no'
        )
            ->whereNotNull('seniors.account_status_id'); 

        if (!empty($barangayId)) {
            $query->where('seniors.barangay_id', $barangayId);
        }

        if (!empty($statusIds)) {
            $query->whereIn('seniors.account_status_id', $statusIds);
        }

        if ($startDate) {
            $query->whereDate('seniors.date_applied', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('seniors.date_applied', '<=', $endDate);
        }

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(CONCAT_WS(' ', seniors.first_name, seniors.middle_name, seniors.last_name, seniors.suffix)) LIKE ?", ['%' . $term . '%']);
                }
            })->orWhere('seniors.osca_id', 'LIKE', '%' . $searchQuery . '%');
        }

        $query->orderBy('seniors.id', $order);

        $seniors = $query->paginate($perPage);

        return response()->json($seniors);
    }

    public function showAdminEncodersList()
    {
        $barangay_list = DB::table('barangay_list')->get();

        $encoders = DB::table('encoder')
        ->leftJoin('encoder_roles', 'encoder_roles.encoder_user_id', '=', 'encoder.id')
        ->leftJoin('encoder_roles_list', 'encoder_roles.encoder_roles_id', '=', 'encoder_roles_list.id')
        ->select(
            'encoder.id',
            'encoder.encoder_id',
            'encoder.encoder_first_name',
            'encoder.encoder_middle_name',
            'encoder.encoder_last_name',
            'encoder.encoder_suffix',
            'encoder.encoder_profile_picture',
            'encoder.encoder_date_registered',
            DB::raw('GROUP_CONCAT(DISTINCT encoder_roles_list.encoder_role_category ORDER BY encoder_roles_list.id) as role_categories'),
            DB::raw('GROUP_CONCAT(DISTINCT encoder_roles_list.encoder_role ORDER BY encoder_roles_list.id) as roles')
        )
            ->groupBy(
                'encoder.id',
                'encoder.encoder_id',
                'encoder.encoder_first_name',
                'encoder.encoder_middle_name',
                'encoder.encoder_last_name',
                'encoder.encoder_suffix',
                'encoder.encoder_profile_picture',
                'encoder.encoder_date_registered'
            )
            ->orderBy('encoder.id', 'asc')
            ->paginate(10);

        $encoderRolesDropdown = DB::table('encoder_roles_list')
        ->select('id', 'encoder_role', 'encoder_role_category')
        ->distinct()
            ->get()
            ->groupBy('encoder_role_category');

        return view('admin.admin_encoders_list', [
            'title' => 'Encoders List',
            'encoderRoles_dropdown' => $encoderRolesDropdown,
            'encoders' => $encoders,
            'barangay_list' => $barangay_list
        ]);
    }

    public function filterEncoders(Request $request)
    {
        $roleCategory = $request->input('encoder_roles_ids', []);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchQuery = $request->input('search_query', '');
        $order = $request->input('order', 'asc');
        $perPage = 10;

        $query = DB::table('encoder')
        ->leftJoin('encoder_roles', 'encoder_roles.encoder_user_id', '=', 'encoder.id')
        ->leftJoin('encoder_roles_list', 'encoder_roles.encoder_roles_id', '=', 'encoder_roles_list.id')
        ->select(
            'encoder.id',
            'encoder.encoder_id',
            'encoder.encoder_first_name',
            'encoder.encoder_middle_name',
            'encoder.encoder_last_name',
            'encoder.encoder_suffix',
            'encoder.encoder_date_registered',
            DB::raw('GROUP_CONCAT(DISTINCT encoder_roles_list.encoder_role_category ORDER BY encoder_roles_list.id) as role_categories'),
            DB::raw('GROUP_CONCAT(encoder_roles_list.encoder_role ORDER BY encoder_roles_list.id) as roles')
        )
        ->groupBy('encoder.id', 'encoder.encoder_id', 'encoder.encoder_first_name','encoder.encoder_middle_name', 'encoder.encoder_last_name','encoder.encoder_suffix', 'encoder.encoder_date_registered')
        ->orderBy('encoder.id', $order);

        if (!empty($roleCategory)) {
            $query->whereIn('encoder_roles_list.id', $roleCategory);
        }

        if ($startDate) {
            $query->whereDate('encoder.encoder_date_registered', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('encoder.encoder_date_registered', '<=', $endDate);
        }

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->whereRaw("LOWER(CONCAT_WS(' ', encoder.encoder_first_name, encoder.encoder_middle_name, encoder.encoder_last_name, encoder.encoder_suffix)) LIKE ?", ['%' . strtolower($searchQuery) . '%'])
                    ->orWhere('encoder.encoder_id', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        $encoders = $query->paginate($perPage);

        return response()->json($encoders);
    }

    public function submitAdminAddEncoder(StoreEncoderRequest $request)
    {
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

        $encoderData['encoder_contact_no'] = '+63' . $encoderData['encoder_contact_no'];

        $encoder_user_type_id = 2;
        $encoderData['encoder_user_type_id'] = $encoder_user_type_id;

        $encoderData['encoder_date_registered'] = now();

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedVerificationCode = Hash::make($verificationCode);

        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $encoderData['encoder_verification_code'] = $hashedVerificationCode;
        $encoderData['encoder_verification_expires_at'] = $expirationTime;

        $unhashedPassword = $encoderData['encoder_last_name'];
        $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 5);
        $randomNumbers = rand(10, 99);
        $generatedPassword = $unhashedPassword . $randomChars . '@' . $randomNumbers;

        $encoderData['encoder_password'] = Hash::make($generatedPassword);

        Encoder::create($encoderData);

        Mail::to($encoderData['encoder_email'])->send(
            new EncoderVerificationEmail($verificationCode, $expirationTime)
        );

        Mail::to($encoderData['encoder_email'])->send(
            new EncoderPassword($generatedPassword)
        );

        return back()->with([
            'admin-message-header' => 'Registration successful',
            'admin-message-body' => 'An email verification has been sent to the user.'
        ]);
    }

    public function showAdminEncoderProfile($encoder_id)
    {
        $encoder = Encoder::leftJoin('barangay_list', 'encoder.encoder_barangay_id', '=', 'barangay_list.id')
        ->leftJoin('encoder_roles', 'encoder_roles.encoder_user_id', '=', 'encoder.id')
        ->leftJoin('encoder_roles_list', 'encoder_roles.encoder_roles_id', '=', 'encoder_roles_list.id')
        ->select(
            'encoder.id',
            'encoder.encoder_id',
            'encoder.encoder_first_name',
            'encoder.encoder_middle_name',
            'encoder.encoder_last_name',
            'encoder.encoder_address',
            'encoder.encoder_email',
            'encoder.encoder_contact_no',
            'encoder.encoder_suffix',
            'encoder.encoder_date_registered',
            'encoder.encoder_profile_picture',
            'encoder.encoder_barangay_id',
            'barangay_list.barangay_no',
            DB::raw('GROUP_CONCAT(encoder_roles_list.encoder_role) as roles')
        )
            ->where('encoder.id', $encoder_id)
            ->groupBy(
                'encoder.id',
                'encoder.encoder_id',
                'encoder.encoder_first_name',
                'encoder.encoder_middle_name',
                'encoder.encoder_last_name',
                'encoder.encoder_address',
                'encoder.encoder_email',
                'encoder.encoder_contact_no',
                'encoder.encoder_suffix',
                'encoder.encoder_date_registered',
                'encoder.encoder_profile_picture',
                'encoder.encoder_barangay_id',
                'barangay_list.barangay_no'
            )
            ->firstOrFail();

        $categories = ['view', 'create', 'update', 'delete'];
        $roles = collect(explode(',', $encoder->roles))
            ->groupBy(function ($role) use ($categories) {
                foreach ($categories as $category) {
                    if (str_contains(strtolower($role), $category)) {
                        return $category;
                    }
                }
                return 'other';
            });

        $categoryColors = [
            'view' => 'green-500',
            'create' => 'blue-500',
            'update' => 'orange-500',
            'delete' => 'red-500',
        ];

        return view('admin.admin_encoder_profile', [
            'encoder' => $encoder,
            'title' => 'Profile: '. $encoder->encoder_first_name . ' ' . $encoder->encoder_last_name,
            'categories' => $categories,
            'roles' => $roles,
            'categoryColors' => $categoryColors,
        ]);
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

    public function showAdminAddBeneficiary()
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

        return view('admin.admin_add_beneficiary')->with([
            'title' => 'Add Beneficiary',
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

    public function submitAdminAddBeneficiary(StoreAddBeneficiary $request)
    {
        //dd($request->all());

        $validated = $request->validated();

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($seniorData['income_source'], $seniorData['other_income_source_remark']);
        unset($seniorData['g-recaptcha-response']);

        do {
            $osca_id = rand(10000, 99999);
        } while (DB::table('seniors')->where('osca_id', $osca_id)->exists());

        $adminUser = auth()->guard('admin')->user();
        $adminUserTypeId = $adminUser->admin_user_type_id;
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $seniorData['registration_assistant_id'] = $adminUserTypeId;
        $seniorData['registration_assistant_name'] = "{$adminFirstName} {$adminLastName}";

        $seniorData['application_assistant_id'] = $adminUserTypeId;
        $seniorData['application_assistant_name'] = "{$adminFirstName} {$adminLastName}";

        $user_type_id = 1;
        $account_status_id = 1;
        $application_status_id = 3;
        $date_approved = now();

        $seniorData['date_applied'] = now();
        $seniorData['osca_id'] = $osca_id;

        $ncsc_rrn = $seniorData['date_applied']->format('Ymd') . '-' . $osca_id;

        $seniorData['ncsc_rrn'] = $ncsc_rrn;

        $seniorData['user_type_id'] = $user_type_id;
        $seniorData['account_status_id'] = $account_status_id;
        $seniorData['application_status_id'] = $application_status_id;
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

        $unhashedPassword = $seniorData['last_name'];
        $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 5);
        $randomNumbers = rand(10, 99);
        $generatedPassword = $unhashedPassword . $randomChars . '@' . $randomNumbers;

        $seniorData['password'] = Hash::make($generatedPassword);

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedVerificationCode = Hash::make($verificationCode);

        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $seniorData['verification_code'] = $hashedVerificationCode;
        $seniorData['verification_expires_at'] = $expirationTime;

        $seniors = Seniors::create($seniorData);

        Mail::to($seniorData['email'])->send(new SeniorRegisteredByStaff($verificationCode, $expirationTime));
        Mail::to($seniorData['email'])->send(new SeniorPassword($generatedPassword));
        Mail::to($seniorData['email'])->send(new SeniorReferenceNumber($ncsc_rrn));

        $lastSourceId = DB::table('source_list')->latest('id')->value('id');

        if (
            $request->input('pensioner') == 1
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

                if (
                    $income_source == $lastIncomeSourceId
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
                    'relative_relationship_id' => $request->relative_relationship_id[$index] ?: null,
                    'relative_age' => $request->relative_age[$index] ?: null,
                    'relative_civil_status_id' => $request->relative_civil_status_id[$index] ?: null,
                    'relative_occupation' => $request->relative_occupation[$index] ?: null,
                    'relative_income' => $request->relative_income[$index] ?: null,
                ]);
            }
        }

        return back()->with([
            'admin-message-header' => 'Registration successful',
            'admin-message-body' => 'An email verification has been sent to the user.'
        ]);
    }

    public function showAdminEditSeniorProfile($id)
    {
        $seniors = Seniors::findOrFail($id);

        $income_sources = DB::table('where_income_source_list')->get();
        $incomes = DB::table('how_much_income_list')->get();
        $pensions = DB::table('how_much_pension_list')->get();
        $sources = DB::table('source_list')->get();
        $arrangement_lists = DB::table('living_arrangement_list')->get();
        $sexes = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $relationship_list = DB::table('relationship_list')->get();
        $barangay = DB::table('barangay_list')->get();

        $senior_guardian = DB::table('senior_guardian')
        ->leftJoin('seniors', 'senior_guardian.senior_id', '=', 'seniors.id')
        ->leftJoin('relationship_list', 'senior_guardian.guardian_relationship_id', '=', 'relationship_list.id')
        ->where('seniors.id', $id)
        ->select('senior_guardian.*', 'relationship_list.relationship')
        ->first();

        $family_composition = DB::table('family_composition')
        ->leftJoin('seniors', 'family_composition.senior_id', '=', 'seniors.id')
        ->leftJoin('civil_status_list', 'family_composition.relative_civil_status_id', '=', 'civil_status_list.id')
        ->leftJoin('relationship_list', 'family_composition.relative_relationship_id', '=', 'relationship_list.id')
        ->where('seniors.id', $id)
        ->select('family_composition.*', 'civil_status_list.civil_status', 'relationship_list.relationship')
        ->get();

        $pension_sources = DB::table('source')
        ->leftJoin('seniors', 'source.senior_id', '=', 'seniors.id')
        ->leftJoin('source_list', 'source.source_id', '=', 'source_list.id')
        ->where('seniors.id', $id)
        ->select('source.source_id', 'source.other_source_remark', 'source_list.id', 'source_list.source_list')
        ->get();

        $income_sources_edit = DB::table('income_source')
        ->leftJoin('seniors', 'income_source.senior_id', '=', 'seniors.id')
        ->leftJoin('where_income_source_list', 'income_source.income_source_id', '=', 'where_income_source_list.id')
        ->where('seniors.id', $id)
        ->select('income_source.income_source_id', 'where_income_source_list.id' , 'where_income_source_list.where_income_source', 'income_source.other_income_source_remark')
        ->get();

        return view('admin.admin_edit_senior_profile')->with([
            'senior' => $seniors,
            'title' => 'Edit: ' . $seniors->first_name . ' ' . $seniors->last_name,
            'income_sources' => $income_sources,
            'incomes' => $incomes,
            'pensions' => $pensions,
            'sources' => $sources,
            'arrangement_lists' => $arrangement_lists,
            'sexes' => $sexes,
            'civil_status_list' => $civil_status_list,
            'relationship_list' => $relationship_list,
            'barangay' => $barangay,
            'senior_guardian' => $senior_guardian,
            'family_composition' => $family_composition,
            'pension_sources' => $pension_sources,
            'income_sources_edit' => $income_sources_edit
        ]);
    }

    public function updateAdminEditBeneficiary(UpdateEditBeneficiary $request, $senior)
    {
        $validated = $request->validated();

        $senior = Seniors::findOrFail($senior);
        $osca_id = $senior->osca_id;

        $seniorData = $validated;

        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($seniorData['income_source'], $seniorData['other_income_source_remark']);
        unset($seniorData['g-recaptcha-response']);

        if ($request->hasFile('valid_id')) {
            if ($senior->valid_id) {
                @unlink(public_path('storage/images/senior_citizen/valid_id/' . $senior->valid_id));
            }
            $validIdFilename = $osca_id . '.' . $request->file('valid_id')->getClientOriginalExtension();
            $request->file('valid_id')->storeAs('images/senior_citizen/valid_id', $validIdFilename);
            $seniorData['valid_id'] = $validIdFilename;
        }

        if ($request->hasFile('profile_picture')) {
            $request->validate(['profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096']);
            $profilePictureFilename = $osca_id . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            if ($senior->profile_picture) {
                @unlink(public_path('storage/images/senior_citizen/profile_picture/' . $senior->profile_picture));
                @unlink(public_path('storage/images/senior_citizen/thumbnail_profile/' . $senior->profile_picture));
            }
            $request->file('profile_picture')->storeAs('images/senior_citizen/profile_picture', $profilePictureFilename);
            $seniorData['profile_picture'] = $profilePictureFilename;

            $thumbnailPath = 'storage/images/senior_citizen/thumbnail_profile/' . $profilePictureFilename;
            $this->createThumbnail(public_path('storage/images/senior_citizen/profile_picture/' . $profilePictureFilename), public_path($thumbnailPath), 150, 150);
        }

        if ($request->hasFile('indigency')) {
            if ($senior->indigency) {
                @unlink(public_path('storage/images/senior_citizen/indigency/' . $senior->indigency));
            }
            $indigencyFilename = $osca_id . '.' . $request->file('indigency')->getClientOriginalExtension();
            $request->file('indigency')->storeAs('images/senior_citizen/indigency', $indigencyFilename);
            $seniorData['indigency'] = $indigencyFilename;
        }

        if ($request->hasFile('birth_certificate')) {
            if ($senior->birth_certificate) {
                @unlink(public_path('storage/images/senior_citizen/birth_certificate/' . $senior->birth_certificate));
            }
            $birthCertificateFilename = $osca_id . '.' . $request->file('birth_certificate')->getClientOriginalExtension();
            $request->file('birth_certificate')->storeAs('images/senior_citizen/birth_certificate', $birthCertificateFilename);
            $seniorData['birth_certificate'] = $birthCertificateFilename;
        }

        $seniorData['contact_no'] = '+63' . ltrim($validated['contact_no'], '0');

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedVerificationCode = Hash::make($verificationCode);

        $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

        $seniorData['verification_code'] = $hashedVerificationCode;
        $seniorData['verification_expires_at'] = $expirationTime;
        $seniorData['verified_at'] = null; 

        $originalEmail = $senior->email; 
        $newEmail = $seniorData['email'];

        if ($newEmail !== $originalEmail) {

            Mail::to($newEmail)->send(new SeniorChangedEmail($verificationCode, $expirationTime));
        }

        $senior->fill($seniorData);
        $senior->save();


        $senior->fill($seniorData); 
        $senior->save();

        if ($request->input('pensioner') == 1) {
            DB::table('source')->where('senior_id', $senior->id)->delete();

            $lastSourceId = DB::table('source_list')->latest('id')->value('id');
            $sourceInputs = $request->input('source') ?? [];

            foreach ($sourceInputs as $source) {
                $source = (int) $source; 

                $otherSourceRemark = $source == $lastSourceId && $request->has("other_source_remark.{$source}")
                    ? $request->input("other_source_remark.{$source}")
                    : null;

                DB::table('source')->insert([
                    'senior_id' => $senior->id,
                    'source_id' => $source,
                    'other_source_remark' => $otherSourceRemark,
                ]);
            }
        }

        if ($request->input('permanent_source') == 1) {
            DB::table('income_source')->where('senior_id', $senior->id)->delete();

            $lastIncomeSourceId = DB::table('where_income_source_list')->latest('id')->value('id');

            $incomeSourceInputs = $request->input('income_source') ?? [];

            foreach ($incomeSourceInputs as $incomeSource) {
                $incomeSource = (int) $incomeSource;

                DB::table('income_source')->insert([
                    'senior_id' => $senior->id,
                    'income_source_id' => $incomeSource,
                    'other_income_source_remark' => ($incomeSource == $lastIncomeSourceId && $request->has('other_income_source_remark'))
                    ? $request->input('other_income_source_remark')
                    : null,
                ]);
            }
        }

        DB::table('senior_guardian')->updateOrInsert(
            ['senior_id' => $senior->id],
            [
                'guardian_first_name' => $request->guardian_first_name ?: null,
                'guardian_middle_name' => $request->guardian_middle_name ?: null,
                'guardian_last_name' => $request->guardian_last_name ?: null,
                'guardian_suffix' => $request->guardian_suffix ?: null,
                'guardian_relationship_id' => $request->guardian_relationship_id ?: null,
                'guardian_contact_no' => $request->guardian_contact_no ? '+63' . ltrim($request->guardian_contact_no, '0') : null,
            ]
        );

        DB::table('family_composition')->where('senior_id', $senior->id)->delete();
        foreach ($request->relative_name as $index => $name) {
            if (!empty($name)) {
                DB::table('family_composition')->insert([
                    'senior_id' => $senior->id,
                    'relative_name' => $name,
                    'relative_relationship_id' => $request->relative_relationship_id[$index] ?: null,
                    'relative_age' => $request->relative_age[$index] ?: null,
                    'relative_civil_status_id' => $request->relative_civil_status_id[$index] ?: null,
                    'relative_occupation' => $request->relative_occupation[$index] ?: null,
                    'relative_income' => $request->relative_income[$index] ?: null,
                ]);
            }
        }

        return back()->with([
            'admin-message-header' => 'Update Successful',
            'admin-message-body' => 'The beneficiary details have been successfully updated.',
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
            'title' => 'Profile'
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
