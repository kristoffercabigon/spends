<?php

namespace App\Http\Controllers;

use App\Models\Encoder;
use App\Models\Seniors;
use App\Models\Guest;
use App\Models\PensionDistribution;
use App\Models\Events;
use App\Models\EventsImages;
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
use App\Http\Requests\StoreAddBeneficiary;
use App\Mail\SeniorReferenceNumber;
use App\Mail\SeniorRegisteredByStaff;
use App\Http\Requests\UpdateEditBeneficiary;
use App\Mail\SeniorChangedEmail;
use App\Mail\EncoderChangedEmail;
use App\Mail\SeniorPassword;
use App\Mail\SeniorSendApprovedEmail;
use App\Models\Barangay;
use App\Models\AccountStatus;
use App\Models\ApplicationStatus;

class EncoderController extends Controller
{
    public function showEncoderIndex()
    {
        return view('encoder.encoder_index')->with('title', 'Home');
    }

    public function about_us()
    {
        return view('encoder.encoder_about_us')->with('title', 'About Us ');
    }

    public function showEncoderProfile($encoder_id)
    {
        $barangay_list = DB::table('barangay_list')->get();

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

        return view('encoder.encoder_profile', [
            'encoder' => $encoder,
            'title' => 'Profile',
            'categories' => $categories,
            'roles' => $roles,
            'categoryColors' => $categoryColors,
            'barangay_list' => $barangay_list
        ]);
    }

    public function showEncoderDashboard()
    {
        $barangay_list = DB::table('barangay_list')->pluck('barangay_no', 'id');

        $application_status_list = DB::table('senior_application_status_list')->pluck('senior_application_status', 'id');

        $applicationStatusCounts = DB::table('seniors')
        ->select('application_status_id', DB::raw('count(*) as total'))
        ->groupBy('application_status_id')
        ->pluck('total', 'application_status_id');

        $applicationStatusData = [];
        foreach ($application_status_list as $id => $status) {
            $applicationStatusData[] = [
                'status' => $status,
                'total' => $applicationStatusCounts[$id] ?? 0
            ];
        }

        $seniorsPerApplicationStatus = DB::table('seniors')
        ->where('application_status_id', 3)
        ->select('barangay_id', DB::raw('count(*) as total'))
        ->groupBy('barangay_id')
        ->pluck('total', 'barangay_id');

        $barangayData = [];
        foreach ($barangay_list as $id => $name) {
            $barangayData[] = [
                'name' => $name,
                'total' => $seniorsPerApplicationStatus[$id] ?? 0
            ];
        }

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
            ->orderBy('seniors.id', 'desc')
            ->paginate(10);

        $accountStatuses = DB::table('senior_account_status_list')->get();
        $barangayList = DB::table('barangay_list')->get();

        return view('encoder.encoder_dashboard', [
            'title' => 'Dashboard',
            'application_status_list' => $application_status_list,
            'applicationStatusData' => $applicationStatusData,  
            'barangay_list' => $barangayData,
            'seniors' => $seniors,
            'accountStatuses' => $accountStatuses,
            'barangayList' => $barangayList,
            'totalApplicationRequests' => \App\Models\Seniors::where('application_status_id', '!=', 3)->count(),
            'totalApplicationsApproved' => \App\Models\Seniors::where('application_status_id', 3)->count(),
        ]);
    }

    public function filterSeniorsDashboardBeneficiaries(Request $request)
    {
        $searchQuery = $request->input('search_query', '');

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

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(CONCAT_WS(' ', seniors.first_name, seniors.middle_name, seniors.last_name, seniors.suffix)) LIKE ?", ['%' . $term . '%']);
                }
            })->orWhere('seniors.osca_id', 'LIKE', '%' . $searchQuery . '%');
        }

        $seniors = $query->orderBy('seniors.id', 'desc')->paginate(10);

        return response()->json($seniors);
    }

    public function showEncoderApplicationRequests()
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

        return view('encoder.encoder_application_requests', [
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

    public function showEncoderSeniorProfile($id)
    {
        $seniors = Seniors::findOrFail($id);

        $sex_list = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $barangay_list = DB::table('barangay_list')->get();
        $relationship_list = DB::table('relationship_list')->get();
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

        $encoderId = auth()->guard('encoder')->id();

        $selectedSex = $sex_list->firstWhere('id', $seniors->sex_id);
        $selectedBarangay = $barangay_list->firstWhere('id', $seniors->barangay_id);
        $selectedCivil_Status = $civil_status_list->firstWhere('id', $seniors->civil_status_id);
        $selectedLiving_Arrangement = $living_arrangement_list->firstWhere('id', $seniors->type_of_living_arrangement);
        $selectedPension_Amount = $how_much_pension_list->firstWhere('id', $seniors->if_pensioner_yes);
        $selectedIncome_Amount = $how_much_income_list->firstWhere('id', $seniors->if_permanent_yes_income);
        $selectedAccount_Status = $senior_account_status_list->firstWhere('id', $seniors->account_status_id);
        $selectedApplication_Status = $senior_application_status_list->firstWhere('id', $seniors->application_status_id);

        $lastLivingArrangementId = $living_arrangement_list->last()->id ?? null;

        return view('encoder.encoder_senior_profile', [
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
            'encoderId' => $encoderId,
        ]);
    }

    public function updateEncoderSeniorApplicationStatus(Request $request, $id)
    {

        $validated = $request->validate([
            'status' => 'required|exists:senior_application_status_list,id',
        ]);

        $encoderUser = auth()->guard('encoder')->user();
        $encoderId = $encoderUser->id;
        $encoderUserTypeId = $encoderUser->encoder_user_type_id;
        $encoderFirstName = $encoderUser->encoder_first_name;
        $encoderLastName = $encoderUser->encoder_last_name;

        $senior = Seniors::findOrFail($id);

        if ($senior->application_status_id == $validated['status']) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Update Unsuccessful',
                'encoder-error-message-body' => 'No changes were detected in the application status.',
            ]);
        }

        if ($senior->application_status_id == 3 && $validated['status'] != 3) {
            $senior->account_status_id = null;
            $senior->application_assistant_id = null;
            $senior->application_encoder_id = null;
            $senior->application_assistant_name = null;
            $senior->date_approved = null;
        }

        $senior->application_status_id = $validated['status'];

        if ($validated['status'] == 3) {
            $senior->account_status_id = 1;
            $senior->application_assistant_id = $encoderUserTypeId;
            $senior->application_encoder_id = $encoderId;
            $senior->application_admin_id = null;
            $senior->application_assistant_name = "{$encoderFirstName} {$encoderLastName}";
            $senior->date_approved = now();
        }

        $senior->save();

        return redirect()->back()->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Application status updated successfully.',
        ]);
    }

    public function EncoderSendApprovedEmail(Request $request, $id)
    {
        $senior = Seniors::findOrFail($id);

        $email = $senior->email;
        $firstName = $senior->first_name;
        $lastName = $senior->last_name;
        $oscaId = $senior->osca_id;

        try {
            Mail::to($email)->send(new SeniorSendApprovedEmail($email, $firstName, $lastName, $oscaId));

            return redirect()->back()->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Email has been sent successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'Failed to send the email. Please try again later.',
            ]);
        }
    }

    public function updateEncoderSeniorAccountStatus(Request $request, $id)
    {

        $validated = $request->validate([
            'account_status' => 'required|exists:senior_account_status_list,id',
        ]);

        $senior = Seniors::findOrFail($id);

        if ($senior->account_status_id == $validated['account_status']) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Update Unsuccessful',
                'encoder-error-message-body' => 'No changes were detected in the account status.',
            ]);
        }

        if ($senior->application_status_id != 3) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Update Unsuccessful',
                'encoder-error-message-body' => 'This user is not approved yet.',
            ]);
        }

        $senior->account_status_id = $validated['account_status'];

        $senior->save();

        return redirect()->back()->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Account status updated successfully.',
        ]);
    }

    public function showEncoderBeneficiariesList()
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

        return view('encoder.encoder_beneficiaries_list', [
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

    public function showEncoderAddBeneficiary()
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

        return view('encoder.encoder_add_beneficiary')->with([
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

    public function submitEncoderAddBeneficiary(StoreAddBeneficiary $request)
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

        $encoderUser = auth()->guard('encoder')->user();
        $encoderId = $encoderUser->id;
        $encoderUserTypeId = $encoderUser->encoder_user_type_id;
        $encoderFirstName = $encoderUser->encoder_first_name;
        $encoderLastName = $encoderUser->encoder_last_name;

        $seniorData['registration_assistant_id'] = $encoderUserTypeId;
        $seniorData['registration_encoder_id'] = $encoderId;
        $seniorData['registration_admin_id'] = null;
        $seniorData['registration_assistant_name'] = "{$encoderFirstName} {$encoderLastName}";

        $seniorData['application_assistant_id'] = $encoderUserTypeId;
        $seniorData['application_encoder_id'] = $encoderId;
        $seniorData['application_admin_id'] = null;
        $seniorData['application_assistant_name'] = "{$encoderFirstName} {$encoderLastName}";

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
                    'relative_relationship_id' => $request->relative_relationship_id[$index] ?? null,
                    'relative_age' => $request->relative_age[$index] ?? null,
                    'relative_civil_status_id' => $request->relative_civil_status_id[$index] ?? null,
                    'relative_occupation' => $request->relative_occupation[$index] ?? null,
                    'relative_income' => $request->relative_income[$index] ?? null,
                ]);
            }
        }

        $status = $seniors ? 'Successful' : 'Failed';
        $changes = "Admin $encoderFirstName $encoderLastName added {$seniorData['first_name']} {$seniorData['middle_name']} {$seniorData['last_name']} with Osca ID {$osca_id} as Beneficiary";

        DB::table('activity_log')->insert([
            'activity' => 'Add Beneficiary',
            'activity_type_id' => 1,
            'changes' => $changes,
            'status' => $status,
            'activity_user_type_id' => 2,
            'activity_encoder_id' => $encoderId,
            'activity_admin_id' => null,
            'created_at' => now(),
        ]);

        return back()->with([
            'encoder-message-header' => 'Registration successful',
            'encoder-message-body' => 'An email verification has been sent to the user.'
        ]);
    }

    public function showEncoderEditSeniorProfile($id)
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
            ->select('income_source.income_source_id', 'where_income_source_list.id', 'where_income_source_list.where_income_source', 'income_source.other_income_source_remark')
            ->get();

        return view('encoder.encoder_edit_senior_profile')->with([
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

    public function updateEncoderEditBeneficiary(UpdateEditBeneficiary $request, $senior)
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

        $originalEmail = $senior->email;
        $newEmail = $seniorData['email'];

        if ($newEmail !== $originalEmail) {

            $seniorData['verification_code'] = $hashedVerificationCode;
            $seniorData['verification_expires_at'] = $expirationTime;
            $seniorData['verified_at'] = null;

            Mail::to($newEmail)->send(new SeniorChangedEmail($verificationCode, $expirationTime));
        }

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
                    'relative_relationship_id' => $request->relative_relationship_id[$index] ?? null,
                    'relative_age' => $request->relative_age[$index] ?? null,
                    'relative_civil_status_id' => $request->relative_civil_status_id[$index] ?? null,
                    'relative_occupation' => $request->relative_occupation[$index] ?? null,
                    'relative_income' => $request->relative_income[$index] ?? null,
                ]);
            }
        }

        return back()->with([
            'encoder-message-header' => 'Update Successful',
            'encoder-message-body' => 'The beneficiary details have been successfully updated.',
        ]);
    }

    public function showEncoderPensionDistributionList()
    {

        $barangayList = DB::table('barangay_list')->get();

        $pension_distributions = DB::table('pension_distribution_list')
        ->leftJoin('barangay_list', 'pension_distribution_list.barangay_id', '=', 'barangay_list.id')
        ->select(
            'pension_distribution_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no'
        )
            ->orderBy('pension_distribution_list.id', 'asc')
            ->paginate(10);

        return view('encoder.encoder_pension_distribution_list', [
            'title' => 'Pension Distribution List',
            'barangayList' => $barangayList,
            'pension_distributions' => $pension_distributions,
        ]);
    }

    public function filterPensionDistributionList(Request $request)
    {
        $barangayId = $request->input('barangay_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderDirection = $request->input('order', 'asc');
        $perPage = 10;

        $query = DB::table('pension_distribution_list')
        ->leftJoin('barangay_list', 'pension_distribution_list.barangay_id', '=', 'barangay_list.id')
        ->select(
            'pension_distribution_list.*',
            'barangay_list.barangay_locality as barangay_locality',
            'barangay_list.barangay_no as barangay_no'
        );

        if (!empty($barangayId)) {
            $query->where('pension_distribution_list.barangay_id', $barangayId);
        }

        if ($startDate) {
            $query->whereDate('pension_distribution_list.date_of_distribution', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('pension_distribution_list.date_of_distribution', '<=', $endDate);
        }

        if ($startDate || $endDate) {
            $query->orderBy('pension_distribution_list.date_of_distribution', $orderDirection);
        } else {
            $query->orderBy('pension_distribution_list.id', $orderDirection);
        }

        $pension_distributions = $query->paginate($perPage);

        return response()->json($pension_distributions);
    }

    public function submitEncoderAddPensionDistribution(Request $request)
    {
        $validatedData = $request->validate([
            'barangay_id.*' => 'required|integer',
            'venue.*' => 'required|string|max:255',
            'date_of_distribution.*' => 'required|date_format:Y-m-d\TH:i',
            'end_time.*' => 'required',
        ], [
            'barangay_id.*.required' => 'Please select a barangay.',
            'barangay_id.*.integer' => 'The barangay selection must be a valid integer.',
            'venue.*.required' => 'Venue is required. Please enter a venue name.',
            'venue.*.string' => 'The venue name must be a valid string.',
            'venue.*.max' => 'The venue name must not exceed 255 characters.',
            'date_of_distribution.*.required' => 'Date and Time of Distribution is required.',
            'date_of_distribution.*.date_format' => 'The date and time must be in the correct format (Y-m-d\TH:i).',
            'end_time.*.required' => 'End time is required.',
        ]);

        $encoderUser = auth()->guard('encoder')->user();
        $encoderId = $encoderUser->id;
        $encoderFirstName = $encoderUser->encoder_first_name;
        $encoderLastName = $encoderUser->encoder_last_name;

        $programs = [];

        try {
            foreach ($validatedData['barangay_id'] as $key => $barangayId) {
                $barangay = Barangay::find($barangayId);
                $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';
                $distributionDate = Carbon::parse($validatedData['date_of_distribution'][$key])->translatedFormat('F j, Y h:i A');

                $programs[] = [
                    'barangay_id' => $barangayId,
                    'venue' => $validatedData['venue'][$key],
                    'date_of_distribution' => $validatedData['date_of_distribution'][$key],
                    'end_time' => $validatedData['end_time'][$key],
                    'pension_user_type_id' => $encoderUser->encoder_user_type_id,
                    'pension_encoder_id' => $encoderId,
                    'pension_admin_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('activity_log')->insert([
                    'activity' => 'Add Pension Distribution Program',
                    'activity_type_id' => 1,
                    'changes' => "Encoder {$encoderFirstName} {$encoderLastName} added Pension Distribution Program for Barangay {$barangayNo} on {$distributionDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 2,
                    'activity_encoder_id' => $encoderId,
                    'activity_admin_id' => null,
                    'created_at' => now(),
                ]);
            }

            DB::table('pension_distribution_list')->insert($programs);

            return redirect()->back()->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Pension distribution added successfully.',
                'clearEncoderAddPensionDistributionModal' => true,
            ]);
        } catch (\Exception $e) {
            DB::table('activity_log')->insert([
                'activity' => 'Add Pension Distribution Program',
                'activity_type_id' => 1,
                'changes' => "Encoder {$encoderFirstName} {$encoderLastName} attempted to add Pension Distribution Programs.",
                'status' => 'Failed',
                'activity_user_type_id' => 2,
                'activity_encoder_id' => $encoderId,
                'activity_admin_id' => null,
                'created_at' => now(),
            ]);

            return redirect()->back()->withErrors([
                'encoder-message-header' => 'Error',
                'encoder-message-body' => 'Failed to add pension distribution. Please try again.',
            ]);
        }
    }

    public function submitEncoderEditPensionDistribution(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required|integer',
            'edit_barangay_id' => 'required|integer',
            'edit_venue' => 'required|string|max:255',
            'edit_date_of_distribution' => 'required|date_format:Y-m-d\TH:i',
            'edit_end_time' => 'required',
        ], [
            'id.required' => 'The ID is required.',
            'id.integer' => 'The ID must be a valid integer.',
            'edit_barangay_id.required' => 'Please select a barangay.',
            'edit_barangay_id.integer' => 'The barangay selection must be a valid integer.',
            'edit_venue.required' => 'Venue is required. Please enter a venue name.',
            'edit_venue.string' => 'The venue name must be a valid string.',
            'edit_venue.max' => 'The venue name must not exceed 255 characters.',
            'edit_date_of_distribution.required' => 'Date and Time of Distribution is required.',
            'edit_date_of_distribution.date_format' => 'The date and time must be in the correct format (Y-m-d\TH:i).',
            'edit_end_time.required' => 'End Time is required.',
        ]);

        $encoderUser = auth()->guard('encoder')->user();
        $encoderUserTypeId = $encoderUser->encoder_user_type_id;
        $encoderId = $encoderUser->id;

        $pensionId = $validatedData['id'];

        $program = [
            'barangay_id' => $validatedData['edit_barangay_id'],
            'venue' => $validatedData['edit_venue'],
            'date_of_distribution' => $validatedData['edit_date_of_distribution'],
            'end_time' => $validatedData['edit_end_time'],
            'pension_user_type_id' => $encoderUserTypeId,
            'pension_encoder_id' => $encoderId,
            'pension_admin_id' => null,
        ];

        $affectedRows = DB::table('pension_distribution_list')
        ->where('id', $pensionId)
        ->update($program);

        if ($affectedRows === 0) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Update Unsuccessful',
                'encoder-error-message-body' => 'No changes were made to the pension distribution program.',
                'clearEncoderEditPensionDistributionModal' => true,
            ]);
        }

        DB::table('pension_distribution_list')
        ->where('id', $pensionId)
            ->update($program);

        return redirect()->back()->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Pension distribution updated successfully.',
            'clearEncoderEditPensionDistributionModal' => true,
        ]);
    }

    public function submitEncoderDeletePensionDistribution(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pension_distribution_list,id',
        ]);

        $pensionDistribution = PensionDistribution::find($request->id);

        if ($pensionDistribution) {
            $barangay = Barangay::find($pensionDistribution->barangay_id);
            $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';
            $distributionDate = Carbon::parse($pensionDistribution->date_of_distribution)->translatedFormat('F j, Y h:i A');

            $encoderUser = auth()->guard('encoder')->user();
            $encoderId = $encoderUser->id;
            $encoderFirstName = $encoderUser->encoder_first_name;
            $encoderLastName = $encoderUser->encoder_last_name;

            try {
                $pensionDistribution->delete();

                DB::table('activity_log')->insert([
                    'activity' => 'Delete Pension Distribution Program',
                    'activity_type_id' => 3,
                    'changes' => "Encoder {$encoderFirstName} {$encoderLastName} deleted Pension Distribution Program for Barangay {$barangayNo} scheduled on {$distributionDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 2,
                    'activity_encoder_id' => $encoderId,
                    'activity_admin_id' => null,
                    'created_at' => now(),
                ]);

                return redirect()->back()->with([
                    'encoder-message-header' => 'Success',
                    'encoder-message-body' => 'Pension distribution deleted successfully.',
                    'clearEncoderDeletePensionDistributionModal' => true,
                ]);
            } catch (\Exception $e) {
                DB::table('activity_log')->insert([
                    'activity' => 'Delete Pension Distribution Program',
                    'activity_type_id' => 3,
                    'changes' => "Encoder {$encoderFirstName} {$encoderLastName} attempted to delete Pension Distribution Program for Barangay {$barangayNo} scheduled on {$distributionDate}",
                    'status' => 'Failed',
                    'activity_user_type_id' => 2,
                    'activity_encoder_id' => $encoderId,
                    'activity_admin_id' => null,
                    'created_at' => now(),
                ]);

                return redirect()->back()->withErrors([
                    'encoder-message-header' => 'Error',
                    'encoder-message-body' => 'Failed to delete pension distribution. Please try again.',
                ]);
            }
        }

        return redirect()->back()->with('error', 'Pension distribution not found.');
    }

    public function getPensionDataForEdit($id)
    {
        $pensionDistribution = PensionDistribution::find($id);

        if ($pensionDistribution) {
            $dateOfDistribution = Carbon::parse($pensionDistribution->date_of_distribution)
                ->setTimezone('Asia/Manila');

            return response()->json([
                'id' => $pensionDistribution->id,
                'barangay_id' => $pensionDistribution->barangay_id,
                'venue' => $pensionDistribution->venue,
                'date_of_distribution' => $dateOfDistribution->format('Y-m-d\TH:i'),
                'end_time' => $pensionDistribution->end_time, 
            ]);
        } else {
            return response()->json(['error' => 'Pension distribution not found'], 404);
        }
    }

    public function getPensionDataForDelete($id)
    {
        $pensionDistribution = PensionDistribution::find($id);

        if ($pensionDistribution) {
            $dateOfDistribution = Carbon::parse($pensionDistribution->date_of_distribution)
                ->setTimezone('Asia/Manila');

            return response()->json([
                'id' => $pensionDistribution->id,
                'barangay_id' => $pensionDistribution->barangay_id,
                'venue' => $pensionDistribution->venue,
                'date_of_distribution' => $dateOfDistribution->format('Y-m-d\TH:i'),
                'end_time' => $pensionDistribution->end_time, 
            ]);
        } else {
            return response()->json(['error' => 'Pension distribution not found'], 404);
        }
    }

    public function showEncoderEventsList()
    {
        $barangayList = DB::table('barangay_list')->get();

        $events = DB::table('events_list')
        ->leftJoin('barangay_list', 'events_list.barangay_id', '=', 'barangay_list.id')
        ->leftJoin('user_type_list', 'events_list.event_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'events_list.event_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'events_list.event_admin_id', '=', 'admin.id')
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
            'user_type_list.user_type'
        )
            ->orderBy('events_list.id', 'asc')
            ->paginate(10);

        return view('encoder.encoder_events_list', [
            'title' => 'Events List',
            'barangayList' => $barangayList,
            'events' => $events,
        ]);
    }

    public function filterEventsList(Request $request)
    {
        $barangayId = $request->input('barangay_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderDirection = $request->input('order', 'asc');
        $isFeatured = $request->input('is_featured'); 
        $perPage = 10;

        $query = DB::table('events_list')
        ->leftJoin('barangay_list', 'events_list.barangay_id', '=', 'barangay_list.id')
        ->leftJoin('user_type_list', 'events_list.event_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'events_list.event_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'events_list.event_admin_id', '=', 'admin.id')
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
            'user_type_list.user_type'
        );

        if (!empty($barangayId)) {
            $query->where('events_list.barangay_id', $barangayId);
        }

        if ($startDate) {
            $query->whereDate('events_list.event_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('events_list.event_date', '<=', $endDate);
        }

        if (isset($isFeatured)) {
            $query->where('events_list.is_featured', $isFeatured);
        }

        if ($startDate || $endDate) {
            $query->orderBy('events_list.event_date', $orderDirection);
        } else {
            $query->orderBy('events_list.id', $orderDirection);
        }

        $events = $query->paginate($perPage);

        return response()->json($events);
    }

    public function getEventDataForView($id)
    {
        $events = Events::find($id);

        if ($events) {
            return response()->json([
                'id' => $events->id,
                'barangay_id' => $events->barangay_id,
                'title' => $events->title,
                'description' => $events->description,
                'event_date' => $events->event_date
            ]);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    public function getEventDataForDelete($id)
    {
        $events = Events::find($id);

        if ($events) {
            $dateOfEvent = Carbon::parse($events->event_date)
                ->setTimezone('Asia/Manila');

            return response()->json([
                'id' => $events->id,
                'title' => $events->title,
                'event_date' => $dateOfEvent->format('Y-m-d\TH:i'),
            ]);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    public function submitEncoderDeleteEvent(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events_list,id',
        ]);

        $eventId = $request->id;
        $event = Events::find($eventId);

        if ($event) {
            $eventTitle = $event->title;
            $eventDate = Carbon::parse($event->date_of_event)->translatedFormat('F j, Y h:i A');

            $encoderUser = auth()->guard('encoder')->user();
            $encoderId = $encoderUser->id;
            $encoderFirstName = $encoderUser->encoder_first_name;
            $encoderLastName = $encoderUser->encoder_last_name;

            try {
                DB::beginTransaction();

                $eventImages = EventsImages::where('event_id', $eventId)->get();
                foreach ($eventImages as $image) {
                    $imagePath = public_path('storage/images/events/' . $image->image);
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                }
                EventsImages::where('event_id', $eventId)->delete();

                $event->delete();

                DB::table('activity_log')->insert([
                    'activity' => 'Delete Event',
                    'activity_type_id' => 3,
                    'changes' => "Encoder {$encoderFirstName} {$encoderLastName} deleted the event titled '{$eventTitle}' scheduled on {$eventDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 2,
                    'activity_encoder_id' => $encoderId,
                    'activity_admin_id' => null,
                    'created_at' => now(),
                ]);

                DB::commit();

                return redirect()->back()->with([
                    'encoder-message-header' => 'Success',
                    'encoder-message-body' => 'Event and associated images deleted successfully.',
                    'clearEncoderDeleteEventModal' => true,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                DB::table('activity_log')->insert([
                    'activity' => 'Delete Event',
                    'activity_type_id' => 3,
                    'changes' => "Encoder {$encoderFirstName} {$encoderLastName} attempted to delete the event titled '{$eventTitle}' scheduled on {$eventDate}",
                    'status' => 'Failed',
                    'activity_user_type_id' => 2,
                    'activity_encoder_id' => $encoderId,
                    'activity_admin_id' => null,
                    'created_at' => now(),
                ]);

                return redirect()->back()->with([
                    'encoder-error-message-header' => 'Deletion Failed',
                    'encoder-error-message-body' => 'An error occurred while deleting the event. Please try again.',
                ]);
            }
        }

        return redirect()->back()->with([
            'encoder-error-message-header' => 'Event Not Found',
            'encoder-error-message-body' => 'The requested event does not exist.',
        ]);
    }

    public function showEncoderAddEvent()
    {

        $barangayList = DB::table('barangay_list')->get();

        return view('encoder.encoder_add_event', [
            'title' => 'Add Event',
            'barangayList' => $barangayList,
        ]);
    }

    public function submitEncoderAddEvent(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:20',
            'description' => 'required|min:100',
            'barangay_id' => 'required',
            'is_featured' => 'required',
            'video' => 'nullable|file|mimes:mp4,avi,mov,mkv,wmv,webm,flv|max:102400',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'title.required' => 'Please enter title.',
            'title.min' => 'Please make title longer.',
            'description.required' => 'Please enter description.',
            'description.min' => 'Please make description longer.',
            'barangay_id.required' => 'Please select a barangay.',
            'is_featured.required' => 'Please specify if the event will be featured or not.',
            'video.max' => 'The maximum size for video is 100 MB.',
            'video.mimes' => 'The video must be a file of type: mp4, avi, mov, mkv, wmv, webm, flv.',
            'images.required' => 'Please upload images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Allowed image types are jpeg, png, jpg, gif, svg.',
        ]);

        $encoderUser = auth()->guard('encoder')->user();
        $encoderUserTypeId = $encoderUser->encoder_user_type_id;
        $encoderId = $encoderUser->id;
        $encoderFirstName = $encoderUser->encoder_first_name;
        $encoderLastName = $encoderUser->encoder_last_name;

        $videoFilenameToStore = null;
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoFilenameToStore = $videoFile->getClientOriginalName();
            $videoFile->storeAs('videos/events', $videoFilenameToStore);
        }

        $event = new Events([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'barangay_id' => $validatedData['barangay_id'],
            'event_date' => now(),
            'is_featured' => $validatedData['is_featured'],
            'video' => $videoFilenameToStore,
            'event_user_type_id' => $encoderUserTypeId,
            'event_encoder_id' => $encoderId,
            'event_admin_id' => null,
        ]);
        $event->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageFilename = $image->getClientOriginalName();
                $image->storeAs('images/events', $imageFilename);

                $isHighlighted = 0;
                if ($request->highlighted_image && $request->highlighted_image === $imageFilename) {
                    $isHighlighted = 1;
                }

                $eventImage = new EventsImages([
                    'event_id' => $event->id,
                    'image' => $imageFilename,
                    'is_highlighted' => $isHighlighted,
                ]);
                $eventImage->save();
            }
        }

        $barangay = Barangay::find($validatedData['barangay_id']);
        $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';

        DB::table('activity_log')->insert([
            'activity' => 'Add Event',
            'activity_type_id' => 1,
            'changes' => "Encoder {$encoderFirstName} {$encoderLastName} added event titled '{$validatedData['title']}' for {$barangayNo} on {$event->event_date->toFormattedDateString()}",
            'status' => 'Successful',
            'activity_user_type_id' => 2,
            'activity_encoder_id' => $encoderId,
            'activity_admin_id' => null,
            'created_at' => now(),
        ]);

        return redirect()->route('encoder-add-event')->with([
            'encoder-message-header' => 'Success',
            'encoder-message-body' => 'Event created successfully.',
        ]);
    }

    public function showEncoderEditEvent($id)
    {
        $events = Events::findOrFail($id);

        $barangayList = DB::table('barangay_list')->get();

        $event_images = DB::table('events_images')
        ->leftJoin('events_list', 'events_images.event_id', '=', 'events_list.id')
        ->where('events_list.id', $id)
        ->select('events_images.image', 'events_images.is_highlighted', 'events_images.event_id')
        ->get();

        return view('encoder.encoder_edit_event', [
            'title' => 'Edit Event',
            'event' => $events,
            'event_images' => $event_images,
            'barangayList' => $barangayList,
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

        $encoder_login = Encoder::where('encoder_email', $encoder_email)->first();

        $encoderUserTypeId = $encoder_login ? $encoder_login->encoder_user_type_id : null;

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            DB::table('user_login_attempts')->insert([
                'email' => $encoder_email,
                'status' => 'Throttled',
                'user_type_id' => $encoderUserTypeId,
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
            DB::table('user_login_attempts')->insert([
                'email' => $encoder_email,
                'status' => 'Failed',
                'user_type_id' => $encoderUserTypeId,
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
            DB::table('user_login_attempts')->insert([
                'email' => $encoder_email,
                'status' => 'Failed',
                'user_type_id' => $encoderUserTypeId,
                'created_at' => now(),
            ]);

            RateLimiter::hit($this->throttleKey($request), 300);

            return back()->withErrors(['encoder_password' => 'Password incorrect.'])->onlyInput('encoder_email');
        }

        $remember = $request->has('remember');

        FacadesAuth::guard('encoder')->login($encoder_login, $remember);
        $request->session()->regenerate();
        $request->session()->put('encoder', $encoder_login);

        DB::table('user_login_attempts')->insert([
            'email' => $encoder_email,
            'status' => 'Successful',
            'user_type_id' => $encoderUserTypeId,
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
            'encoder_address' => 'required|min:20|max:100',
            'encoder_barangay_id' => 'required',
            'encoder_contact_no' => 'required',
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
        $encoder->encoder_address = $request->encoder_address;
        $encoder->encoder_barangay_id = $request->encoder_barangay_id;
        $encoder->encoder_contact_no = $request->encoder_contact_no;
        $encoder->encoder_email = $request->encoder_email;

        $changesMade = false;
        if (
            $encoder->encoder_first_name !== $originalValues['encoder_first_name'] ||
            $encoder->encoder_middle_name !== $originalValues['encoder_middle_name'] ||
            $encoder->encoder_last_name !== $originalValues['encoder_last_name'] ||
            $encoder->encoder_suffix !== $originalValues['encoder_suffix'] ||
            $encoder->encoder_address !== $originalValues['encoder_address'] ||
            $encoder->encoder_barangay_id !== $originalValues['encoder_barangay_id'] ||
            $encoder->encoder_contact_no !== $originalValues['encoder_contact_no'] ||
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
            'encoder_address' => $request->encoder_address,
            'encoder_barangay_id' => $request->encoder_barangay_id,
            'encoder_contact_no' => $request->encoder_contact_no,
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
                $originalEmail = $encoder->encoder_email;
                $newEmail = $updatedData['encoder_email'];

                if ($newEmail !== $originalEmail) {
                    $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $hashedVerificationCode = Hash::make($verificationCode);
                    $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

                    $encoder->encoder_verification_code = $hashedVerificationCode;
                    $encoder->encoder_verification_expires_at = $expirationTime;
                    $encoder->encoder_verified_at = null;

                    Mail::to($newEmail)->send(new EncoderChangedEmail($verificationCode, $expirationTime));
                }

                $encoder->encoder_first_name = $updatedData['encoder_first_name'];
                $encoder->encoder_middle_name = $updatedData['encoder_middle_name'];
                $encoder->encoder_last_name = $updatedData['encoder_last_name'];
                $encoder->encoder_suffix = $updatedData['encoder_suffix'];
                $encoder->encoder_address = $updatedData['encoder_address'];
                $encoder->encoder_barangay_id = $updatedData['encoder_barangay_id'];
                $encoder->encoder_contact_no = $updatedData['encoder_contact_no'];
                $encoder->encoder_email = $updatedData['encoder_email'];

                $encoder->save();

                session()->forget('updated_profile_data');

                return redirect('/encoder/profile/' . $encoder->id)->with([
                    'clearEncoderEditProfileModal' => true,
                    'clearEncoderVerifyCurrentPasswordModal' => true,
                    'encoder-message-header' => 'Success',
                    'encoder-message-body' => $newEmail !== $originalEmail
                        ? 'Profile updated successfully. Please verify your new email address.'
                        : 'Profile updated successfully.',
                ]);
            }
        } else {
            return redirect()->back()->withErrors(['encoder_current_password' => 'Password is incorrect.']);
        }
    }
}
