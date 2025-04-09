<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Seniors;
use App\Models\Encoder;
use App\Models\PensionDistribution;
use App\Models\Events;
use App\Models\EventsImages;
use App\Mail\AdminResendCodeEmail;
use App\Mail\AdminForgotPassword;
use App\Mail\AdminLoginAttempt;
use App\Mail\AdminComposeMessageEmail;
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
use App\Mail\SeniorSendApprovedEmail;
use App\Mail\AdminChangedEmail;
use App\Http\Requests\StoreAddBeneficiary;
use App\Http\Requests\UpdateEditBeneficiary;
use App\Mail\SeniorPassword;
use App\Mail\EncoderVerificationEmail;
use App\Mail\EncoderPassword;
use App\Mail\EncoderChangedEmail;
use App\Http\Requests\StoreEncoderRequest;
use App\Models\Barangay;
use App\Models\AccountStatus;
use App\Models\ApplicationStatus;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Messages;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AdminController extends Controller
{

    public function getPensionData(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $nodeScript = base_path('resources/js/fetchPension.js');
        $output = shell_exec("node $nodeScript");

        if (!$output) {
            Log::error('No pension data found on blockchain.');
            return response()->json(['success' => false, 'message' => 'No pension data found on blockchain']);
        }

        $pensionData = json_decode($output, true);

        if (!$pensionData || !$pensionData['success']) {
            Log::error('Error fetching pension data.', ['output' => $output]);
            return response()->json(['success' => false, 'message' => 'Error fetching pension data']);
        }

        $oldestYear = DB::table('seniors')
            ->whereIn('id', $pensionData['senior_ids'])
            ->whereNotNull('date_approved')
            ->orderBy('date_approved', 'asc')
            ->value(DB::raw('YEAR(date_approved)'));

        $oldestYear = $oldestYear ?? 2015;

        $beneficiariesPerMonth = DB::table('seniors')
            ->whereIn('id', $pensionData['senior_ids'])
            ->whereYear('date_approved', $year)
            ->select(DB::raw('DATE_FORMAT(date_approved, "%Y-%m") as month, COUNT(*) as total_beneficiaries'))
            ->groupBy(DB::raw('DATE_FORMAT(date_approved, "%Y-%m")'))
            ->get();

        $chartData = $beneficiariesPerMonth->map(function ($item) {
            return [
                'month' => $item->month,
                'total_beneficiaries' => $item->total_beneficiaries,
            ];
        });

        $beneficiariesPerBarangay = DB::table('seniors')
            ->join('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
            ->whereIn('seniors.id', $pensionData['senior_ids'])
            ->whereIn('account_status_id', [1, 2])
            ->where('application_status_id', 3)
            ->groupBy('barangay_list.id', 'barangay_list.barangay_no')
            ->select(
                'barangay_list.id as barangay_id',
                'barangay_list.barangay_no as barangay_name',
                DB::raw('COUNT(seniors.id) as total_beneficiaries')
            )
            ->get();

        $seniors = DB::table('seniors')
            ->leftJoin('sex_list', 'seniors.sex_id', '=', 'sex_list.id')
            ->leftJoin('barangay_list', 'seniors.barangay_id', '=', 'barangay_list.id')
            ->whereIn('seniors.id', $pensionData['senior_ids'])
            ->whereIn('account_status_id', [1, 2])
            ->where('application_status_id', 3)
            ->select(
                'seniors.*',
                'sex_list.sex as sex_name',
                'barangay_list.barangay_no as barangay_no'
            )
            ->orderBy('seniors.date_approved', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'total_beneficiaries' => $pensionData['total_beneficiaries'],
            'total_pension_amount' => $pensionData['total_pension_amount'],
            'timestamp' => $pensionData['timestamp'],
            'current_block_hash' => $pensionData['current_block_hash'],
            'previous_block_hash' => $pensionData['previous_block_hash'],
            'senior_ids' => $pensionData['senior_ids'],
            'chart_data' => $chartData,
            'oldest_year' => $oldestYear,
            'seniors' => $seniors,
            'beneficiaries_per_barangay' => $beneficiariesPerBarangay,
        ]);
    }

    public function storePensionData()
    {
        $seniorIds = DB::table('seniors')
            ->where('application_status_id', 3)
            ->whereIn('account_status_id', [1, 2])
            ->pluck('id')
            ->toArray();

        $totalBeneficiaries = count($seniorIds);

        if ($totalBeneficiaries == 0) {
            Log::error("No verified seniors found.");
            return response()->json(['success' => false, 'message' => 'No verified seniors found.']);
        }

        $totalPensionAmount = $totalBeneficiaries * 1000;

        $pensionData = [
            'total_beneficiaries' => $totalBeneficiaries,
            'total_pension_amount' => $totalPensionAmount,
            'senior_ids' => $seniorIds, 
        ];

        $tempFilePath = storage_path('pension_data.json');
        file_put_contents($tempFilePath, json_encode($pensionData, JSON_PRETTY_PRINT));

        $nodeScript = base_path('resources/js/storePension.js');
        $command = "node " . escapeshellarg($nodeScript) . " " . escapeshellarg($tempFilePath);

        Log::info("Executing command: $command");

        $output = shell_exec("$command 2>&1");
        Log::info("Node.js Output: " . print_r($output, true));

        if (!$output) {
            Log::error("Error executing pension storage script.");
            return response()->json(['success' => false, 'message' => 'Error executing pension storage script.']);
        }

        return response()->json(['success' => true, 'message' => 'Pension data stored successfully.']);
    }

    public function detectFraudulentActivity()
    {
        $year = date('Y');

        // Fetch beneficiaries per month for the past 12 months
        $beneficiariesPerMonth = DB::table('seniors')
            ->where('application_status_id', 3)
            ->whereYear('date_approved', '>=', $year - 1)
            ->select(
                DB::raw('DATE_FORMAT(date_approved, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total_beneficiaries')
            )
            ->groupBy(DB::raw('DATE_FORMAT(date_approved, "%Y-%m")'))
            ->orderBy('month', 'asc')
            ->get();

        if ($beneficiariesPerMonth->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data available for analysis']);
        }

        // Convert data to array
        $growthData = [];
        $previousMonthBeneficiaries = null;
        foreach ($beneficiariesPerMonth as $data) {
            $currentMonth = $data->month;
            $currentTotal = $data->total_beneficiaries;

            // Calculate percentage increase
            $growthRate = null;
            if ($previousMonthBeneficiaries !== null && $previousMonthBeneficiaries > 0) {
                $growthRate = (($currentTotal - $previousMonthBeneficiaries) / $previousMonthBeneficiaries) * 100;
            }

            // Store data
            $growthData[] = [
                'month' => $currentMonth,
                'total_beneficiaries' => $currentTotal,
                'growth_rate' => $growthRate ? round($growthRate, 2) : 0
            ];

            $previousMonthBeneficiaries = $currentTotal;
        }

        // Detect spikes (Threshold: >50% growth)
        $fraudDetected = array_filter($growthData, function ($item) {
            return $item['growth_rate'] > 50;
        });

        return response()->json([
            'success' => true,
            'growth_data' => $growthData,
            'suspicious_months' => array_values($fraudDetected)
        ]);
    }


    public function verifyPasswordHash(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $admin = auth()->guard('admin')->user();

        if (!$admin || !Hash::check($request->password, $admin->admin_password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password. Please try again.'
            ], 403);
        }

        $nodeScript = base_path('resources/js/fetchPension.js');
        $command = "node $nodeScript";
        $output = shell_exec($command);

        if (!$output) {
            return response()->json(['success' => false, 'message' => 'No pension data found on blockchain']);
        }

        $pensionData = json_decode($output, true);

        if (!$pensionData || !$pensionData['success']) {
            return response()->json(['success' => false, 'message' => 'Error fetching pension data']);
        }


        return response()->json([
            'success' => true,
            'current_block_hash' => $pensionData['current_block_hash'],
            'previous_block_hash' => $pensionData['previous_block_hash'],
        ]);
    }

    public function showAdminBlockchain()
    {
        $sex_list = DB::table('sex_list')->get();
        $civil_status_list = DB::table('civil_status_list')->get();
        $barangayList = DB::table('barangay_list')->get();
        $user_type_list = DB::table('user_type_list')->get();
        $living_arrangement_list = DB::table('living_arrangement_list')->get();
        $how_much_pension_list = DB::table('how_much_pension_list')->get();
        $how_much_income_list = DB::table('how_much_income_list')->get();
        $senior_account_status_list = DB::table('senior_account_status_list')->get();
        $senior_application_status_list = DB::table('senior_application_status_list')->get();
        $accountStatuses = DB::table('senior_account_status_list')->get();

        return view('admin.admin_blockchain')->with([
            'title' => 'Blockchain',
            '$sex_list' => $sex_list,
            'civil_status_list' => $civil_status_list,
            'barangayList' => $barangayList,
            'accountStatuses' => $accountStatuses,
            'living_arrangement_list' => $living_arrangement_list,
            'user_type_list' => $user_type_list,
            'how_much_pension_list' => $how_much_pension_list,
            'how_much_income_list' => $how_much_income_list,
            'senior_account_status_list' => $senior_account_status_list,
            'senior_application_status_list' => $senior_application_status_list,
        ]);
    }

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
        $barangay_list = DB::table('barangay_list')->pluck('barangay_no', 'id');

        $application_status_list = DB::table('senior_application_status_list')->pluck('senior_application_status', 'id');

        $account_status_list = DB::table('senior_account_status_list')->pluck('senior_account_status', 'id');

        $applicationStatusCounts = DB::table('seniors')
        ->select('application_status_id', DB::raw('count(*) as total'))
        ->groupBy('application_status_id')
        ->pluck('total', 'application_status_id');

        $accountStatusCounts = DB::table('seniors')
        ->select('account_status_id', DB::raw('count(*) as total'))
        ->groupBy('account_status_id')
        ->pluck('total', 'account_status_id');

        $applicationStatusData = [];
        foreach ($application_status_list as $id => $status) {
            $applicationStatusData[] = [
                'status' => $status,
                'total' => $applicationStatusCounts[$id] ?? 0
            ];
        }

        $applicationStatusDataforDoughnut = [];
        foreach ($application_status_list as $id => $status) {
            $applicationStatusDataforDoughnut[] = [
                'status' => $status,
                'total' => $applicationStatusCounts[$id] ?? 0
            ];
        }

        $accountStatusData = [];
        foreach ($account_status_list as $id => $status) {
            $accountStatusData[] = [
                'status' => $status,
                'total' => $accountStatusCounts[$id] ?? 0
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

        $data = DB::table('seniors')
        ->select(DB::raw('YEAR(date_applied) as year'), DB::raw('COUNT(*) as beneficiaries'))
        ->where('application_status_id', 3)
        ->groupBy(DB::raw('YEAR(date_applied)'))
        ->orderBy(DB::raw('YEAR(date_applied)'))
        ->get();

        $years = [];
        $beneficiaries = [];
        $cumulativeBeneficiaries = 0;
        $inflation = 3.0; 

        foreach ($data as $row) {
            $years[] = $row->year;
            $cumulativeBeneficiaries += $row->beneficiaries;
            $beneficiaries[] = $cumulativeBeneficiaries;
            $total_Beneficiaries[] = $row->beneficiaries;
        }

        $features = [];
        foreach ($years as $i => $year) {
            $inflation = $inflationData[$year] ?? 3.0;

            $features[] = [
                $year,
                $beneficiaries[$i],
                $inflation  
            ];
        }

        $applicationStatusData = [
            'under_evaluation' => \App\Models\Seniors::where('application_status_id', 1)->count(),
            'on_hold' => \App\Models\Seniors::where('application_status_id', 2)->count(),
            'approved' => \App\Models\Seniors::where('application_status_id', 3)->count(),
            'rejected' => \App\Models\Seniors::where('application_status_id', 4)->count(),
        ];

        return view('admin.admin_dashboard', [
            'title' => 'Dashboard',
            'application_status_list' => $application_status_list,
            'applicationStatusData' => $applicationStatusData,
            'applicationStatusDataforDoughnut' => $applicationStatusDataforDoughnut,
            'accountStatusData' => $accountStatusData,
            'barangay_list' => $barangayData,
            'seniors' => $seniors,
            'accountStatuses' => $accountStatuses,
            'barangayList' => $barangayList,
            'chartData' => $chartData ?? [],
            'total_Beneficiaries' => $total_Beneficiaries,
            'totalApplicationRequests' => \App\Models\Seniors::whereIn('application_status_id', [1, 2])->count(),
            'totalApplicationsApproved' => \App\Models\Seniors::where('application_status_id', 3)->count(),
            'totalApplicationsRejected' => \App\Models\Seniors::where('application_status_id', 4)->count(),
            'totalBeneficiaries' => \App\Models\Seniors::where('application_status_id', 3)
                ->where(function ($query) {
                    $query->where('account_status_id', 1)
                        ->orWhere('account_status_id', 2);
                })->count(),
        ]);
    }

    public function showAdminMessages()
    {
        $barangayList = DB::table('barangay_list')->get();
        $messageTemplate = DB::table('message_template')->get();
        $applicationStatusList = DB::table('senior_application_status_list')->get();
        $accountStatusList = DB::table('senior_account_status_list')->get();

        $messages = DB::table('contact_us')
        ->leftJoin('message_type_list', 'contact_us.message_type_id', '=', 'message_type_list.id')
        ->select(
            'contact_us.*',
            'message_type_list.message_type',
        )
            ->orderBy('contact_us.id', 'asc')
            ->paginate(10);

        $message_types = DB::table('message_type_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        return view('admin.admin_messages', [
            'title' => 'Messages',
            'message_types' => $message_types,
            'messages' => $messages,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
            'barangayList' => $barangayList,
            'applicationStatusList' => $applicationStatusList,
            'accountStatusList' => $accountStatusList,
            'messageTemplate' => $messageTemplate,
        ]);
    }

    public function filterAdminMessages(Request $request)
    {
        $messageTypeId = $request->input('message_type_id');
        $searchQuery = $request->input('search_query', '');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderDirection = $request->input('order', 'desc');
        $messageMedium = $request->input('message_medium_id', 'all');
        $perPage = 10;

        $query = DB::table('contact_us')
        ->leftJoin('message_type_list', 'contact_us.message_type_id', '=', 'message_type_list.id')
        ->select('contact_us.*', 'message_type_list.message_type');

        if (!empty($messageTypeId)) {
            $query->where('contact_us.message_type_id', $messageTypeId);
        }

        if ($startDate) {
            $query->whereDate('contact_us.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('contact_us.created_at', '<=', $endDate);
        }

        if ($startDate || $endDate) {
            $query->orderBy('contact_us.created_at', $orderDirection);
        } else {
            $query->orderBy('contact_us.id', $orderDirection);
        }

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));
            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(contact_us.name) LIKE ?", ['%' . $term . '%']);
                }
            })->orWhere('contact_us.name', 'LIKE', '%' . $searchQuery . '%');
        }

        if ($messageMedium === 'email') {
            $query->where(function ($q) {
                $q->whereNotNull('contact_us.sent_by_email')
                ->orWhereNotNull('contact_us.sent_to_email');
            });
        } elseif ($messageMedium === 'sms') {
            $query->where(function ($q) {
                $q->whereNotNull('contact_us.sent_by_contact')
                ->orWhereNotNull('contact_us.sent_to_contact');
            });
        }

        $messages = $query->paginate($perPage);

        return response()->json($messages);
    }

    public function submitAdminComposeMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'message_type' => 'required|in:email,sms',
            'email_subject' => $request->message_type === 'email' ? 'required|string|max:255' : 'nullable|string|max:255',
            'email_to' => $request->message_type === 'email' && !$request->has('bulk_message') ? 'required|string' : 'nullable|string',
            'attachment' => $request->message_type === 'email' ? 'nullable|file|max:5120' : 'nullable',
            'number' => $request->message_type === 'sms' && !$request->has('bulk_message') ? 'required|string' : 'nullable|string',
            'barangay_id' => ['nullable', function ($attribute, $value, $fail) {
                if ($value !== 'none' && !ctype_digit($value)) {
                    $fail('The ' . $attribute . ' field must be an integer or "none".');
                }
            }],
            'application_status_id' => ['nullable', function ($attribute, $value, $fail) {
                if ($value !== 'none' && !ctype_digit($value)) {
                    $fail('The ' . $attribute . ' field must be an integer or "none".');
                }
            }],
            'account_status_id' => ['nullable', function ($attribute, $value, $fail) {
                if ($value !== 'none' && !ctype_digit($value)) {
                    $fail('The ' . $attribute . ' field must be an integer or "none".');
                }
            }],
        ]);

        if ($request->message_type === 'email') {
            $emails = [];

            if ($request->has('bulk_message')) {
                $query = Seniors::query();

                if ($request->barangay_id !== 'none') {
                    $query->where('barangay_id', $request->barangay_id);
                }
                if ($request->application_status_id !== 'none') {
                    $query->where('application_status_id', $request->application_status_id);
                }
                if ($request->account_status_id !== 'none') {
                    $query->where('account_status_id', $request->account_status_id);
                }

                $emails = $query->pluck('email')->filter()->toArray();
            } else {
                $emails = explode(',', $request->email_to);
                $emails = array_map('trim', $emails);
                $emails = array_filter($emails, function ($email) {
                    return filter_var($email, FILTER_VALIDATE_EMAIL);
                });
            }

            if (empty($emails)) {
                return redirect()->back()->with([
                    'admin-error-message-header' => 'Error',
                    'admin-error-message-body' => 'No valid email addresses provided.',
                ]);
            }

            do {
                $message_id = rand(10000, 99999);
            } while (DB::table('contact_us')->where('message_id', $message_id)->exists());

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentExtension = $request->file('attachment')->getClientOriginalExtension();
                $attachmentFilenameToStore = $message_id . '.' . $attachmentExtension;
                $request->file('attachment')->storeAs('images/admin/admin_message_attachments', $attachmentFilenameToStore, 'public');
                $attachmentPath =
                'images/admin/admin_message_attachments/' . $attachmentFilenameToStore;
            }

            Mail::to(array_shift($emails))
                ->cc($emails)
                ->send(new AdminComposeMessageEmail($request->email_subject, $request->message, $attachmentPath));

            $adminUser = auth()->guard('admin')->user();
            $adminEmail = $adminUser->admin_email;

            DB::table('contact_us')->insert([
                'message_id' => $message_id,
                'message_type_id' => 2,
                'is_favorite' => 0,
                'sent_by_email' => $adminEmail,
                'sent_to_email' => $request->email_to, 
                'message_attachment' => $attachmentPath,
                'subject' => $request->email_subject,
                'message' => $request->message,
                'created_at' => now(),
            ]);

            foreach ($emails as $email) {
                do {
                    $unique_message_id = rand(10000, 99999);
                } while (DB::table('contact_us')->where('message_id', $unique_message_id)->exists());

                DB::table('contact_us')->insert([
                    'message_id' => $unique_message_id, 
                    'message_type_id' => 2,
                    'is_favorite' => 0,
                    'sent_by_email' => $adminEmail,
                    'sent_to_email' => $email,
                    'message_attachment' => $attachmentPath,
                    'subject' => $request->email_subject,
                    'message' => $request->message,
                    'created_at' => now(),
                ]);
            }

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Email Message sent successfully.',
                'clearAdminComposeMessageModal' => true,
            ]);
        } elseif ($request->message_type === 'sms') {
            $numbers = [];

            if ($request->has('bulk_message')) {
                $query = Seniors::query();

                if ($request->barangay_id !== 'none') {
                    $query->where('barangay_id', $request->barangay_id);
                }
                if ($request->application_status_id !== 'none') {
                    $query->where('application_status_id', $request->application_status_id);
                }
                if ($request->account_status_id !== 'none') {
                    $query->where('account_status_id', $request->account_status_id);
                }

                $numbers = $query->pluck('contact_no')->filter()->toArray();
            } else {
                $numbers = explode(',', $request->number);
                $numbers = array_map('trim', $numbers);
            }

            if (empty($numbers)) {
                return redirect()->back()->with([
                    'admin-error-message-header' => 'Error',
                    'admin-error-message-body' => 'No valid phone numbers provided.',
                ]);
            }

            do {
                $message_id = rand(10000, 99999);
            } while (DB::table('contact_us')->where('message_id', $message_id)->exists());

            $apiKey = "881470b412b45a924eac9ef6ed6a3f13";
            $senderName = "SPENDS";

            $response = Http::post('https://api.semaphore.co/api/v4/messages', [
                'apikey' => $apiKey,
                'number' => implode(',', $numbers),
                'message' => $request->message,
                'sendername' => $senderName,
            ]);

            if (!$response->successful()) {
                return redirect()->back()->with([
                    'admin-error-message-header' => 'Error',
                    'admin-error-message-body' => 'Failed to send SMS message.',
                ]);
            }

            $adminUser = auth()->guard('admin')->user();
            $adminContact = "SPENDS";

            DB::table('contact_us')->insert([
                'message_id' => $message_id,
                'message_type_id' => 2,
                'is_favorite' => 0,
                'sent_by_email' => null,
                'sent_to_email' => null,
                'sent_by_contact' => $adminContact,
                'sent_to_contact' => implode(',', $numbers),
                'message_attachment' => null,
                'subject' => null,
                'message' => $request->message,
                'created_at' => now(),
            ]);

            foreach ($numbers as $number) {
                do {
                    $unique_message_id = rand(10000, 99999);
                } while (DB::table('contact_us')->where('message_id', $unique_message_id)->exists());

                DB::table('contact_us')->insert([
                    'message_id' => $unique_message_id,
                    'message_type_id' => 2,
                    'is_favorite' => 0,
                    'sent_by_email' => null,
                    'sent_to_email' => null,
                    'sent_by_contact' => $adminContact,
                    'sent_to_contact' => $number,
                    'message_attachment' => null,
                    'subject' => null,
                    'message' => $request->message,
                    'created_at' => now(),
                ]);
            }

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'SMS Message sent successfully.',
                'clearAdminComposeMessageModal' => true,
            ]);
        }
    }

    public function getMessageDataForView($id)
    {
        $messages = Messages::find($id);

        if ($messages) {
            return response()->json([
                'id' => $messages->id,
                'name' => $messages->name,
                'sent_by_email' => $messages->sent_by_email,
                'sent_to_email' => $messages->sent_to_email,
                'sent_by_contact' => $messages->sent_by_contact,
                'sent_to_contact' => $messages->sent_to_contact,
                'subject' => $messages->subject,
                'message' => $messages->message,
                'message_attachment' => $messages->message_attachment,
                'created_at' => $messages->created_at
            ]);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }

    public function getMessageDataForTrash($id)
    {
        $messages = Messages::find($id);

        if ($messages) {
            $dateOfMessage = Carbon::parse($messages->created_at)
                ->setTimezone('Asia/Manila');

            return response()->json([
                'id' => $messages->id,
                'sent_by_email' => $messages->sent_by_email,
                'sent_to_email' => $messages->sent_to_email,
                'sent_by_contact' => $messages->sent_by_contact,
                'sent_to_contact' => $messages->sent_to_contact,
                'subject' => $messages->subject,
                'created_at' => $dateOfMessage->format('Y-m-d\TH:i'),
            ]);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }

    public function getMessageDataForRestore($id)
    {
        $messages = Messages::find($id);

        if ($messages) {
            $dateOfMessage = Carbon::parse($messages->created_at)
                ->setTimezone('Asia/Manila');

            return response()->json([
                'id' => $messages->id,
                'sent_by_email' => $messages->sent_by_email,
                'sent_to_email' => $messages->sent_to_email,
                'sent_by_contact' => $messages->sent_by_contact,
                'sent_to_contact' => $messages->sent_to_contact,
                'subject' => $messages->subject,
                'created_at' => $dateOfMessage->format('Y-m-d\TH:i'),
            ]);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }

    public function submitAdminTrashMessage(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:contact_us,id',
        ]);

        try {
            Messages::where('id', $request->id)->update(['message_type_id' => 3]);

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Message moved to trash successfully.',
                'clearAdminTrashMessageModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'An error occurred while moving the message to trash.',
            ]);
        }
    }

    public function submitAdminRestoreMessage(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:contact_us,id',
        ]);

        try {
            $message = Messages::findOrFail($request->id);

            $messageTypeId = empty($message->sent_to_email) && empty($message->sent_to_contact) ? 1 : 2;

            $message->update(['message_type_id' => $messageTypeId]);

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Message restored successfully.',
                'clearAdminRestoreMessageModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'An error occurred while restoring the message.',
            ]);
        }
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

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        return view('admin.admin_application_requests', [
            'title' => 'Application Requests',
            'seniors' => $seniors,
            'applicationStatuses' => $applicationStatuses,
            'barangayList' => $barangayList,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
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
        $archived = $request->input('is_archived');
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

            $query->where(function ($q) use ($terms, $searchQuery) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(CONCAT_WS(' ', seniors.first_name, seniors.middle_name, seniors.last_name, seniors.suffix)) LIKE ?", ['%' . $term . '%']);
                }
            })->orWhere('seniors.osca_id', 'LIKE', '%' . $searchQuery . '%');
        }

        if (isset($archived)) {
            $query->where('seniors.is_application_archived', $archived);
        }

        if ($startDate || $endDate) {
            $query->orderBy('seniors.date_applied', $orderDirection);
        } else {
            $query->orderBy('seniors.id', $orderDirection);
        }

        $seniors = $query->paginate($perPage);

        return response()->json($seniors);
    }

    public function getApplicationDataForArchive($id)
    {
        $senior = Seniors::find($id);

        if ($senior) {

            return response()->json([
                'id' => $senior->id,
                'first_name' => $senior->first_name,
                'middle_name' => $senior->middle_name,
                'last_name' => $senior->last_name,
                'suffix' => $senior->suffix,
                'osca_id' => $senior->osca_id,
            ]);
        } else {
            return response()->json(['error' => 'Senior not found'], 404);
        }
    }

    public function submitAdminArchiveApplication(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:seniors,id',
        ]);

        try {
            Seniors::where('id', $request->id)->update(['is_application_archived' => 1]);

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Senior profile archived successfully.',
                'clearAdminArchiveSeniorApplicationModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'An error occurred while archiving senior profile.',
            ]);
        }
    }

    public function getApplicationDataForRestore($id)
    {
        $senior = Seniors::find($id);

        if ($senior) {

            return response()->json([
                'id' => $senior->id,
                'first_name' => $senior->first_name,
                'middle_name' => $senior->middle_name,
                'last_name' => $senior->last_name,
                'suffix' => $senior->suffix,
                'osca_id' => $senior->osca_id,
            ]);
        } else {
            return response()->json(['error' => 'Senior not found'], 404);
        }
    }

    public function submitAdminRestoreApplication(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:seniors,id',
        ]);

        try {
            Seniors::where('id', $request->id)->update(['is_application_archived' => 0]);

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Senior Application restored successfully.',
                'clearAdminRestoreApplicationModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'An error occurred while restoring the senior application.',
            ]);
        }
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

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

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
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
        ]);
    }

    public function updateAdminSeniorApplicationStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|exists:senior_application_status_list,id',
        ]);

        $adminUser = auth()->guard('admin')->user();
        $adminId = $adminUser->id;
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
            $senior->application_admin_id = null;
            $senior->date_approved = null;
        }

        $senior->application_status_id = $validated['status'];

        if ($validated['status'] == 3) {
            $senior->account_status_id = 1;
            $senior->date_approved = now();
            $senior->application_assistant_id = $adminUserTypeId;
            $senior->application_admin_id = $adminId;
            $senior->application_encoder_id = null;
            $senior->application_assistant_name = "{$adminFirstName} {$adminLastName}";
        }

        $senior->save();

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Application status updated successfully.',
        ]);
    }

    public function AdminSendApprovedEmail(Request $request, $id)
    {
        $senior = Seniors::findOrFail($id);

        $email = $senior->email;
        $firstName = $senior->first_name;
        $lastName = $senior->last_name;
        $oscaId = $senior->osca_id;

        try {
            Mail::to($email)->send(new SeniorSendApprovedEmail($email, $firstName, $lastName, $oscaId));

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Email has been sent successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Failed',
                'admin-error-message-body' => 'Failed to send the email. Please try again later.',
            ]);
        }
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

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        return view('admin.admin_beneficiaries_list', [
            'title' => 'Beneficiaries List',
            'seniors' => $seniors,
            'accountStatuses' => $accountStatuses,
            'barangayList' => $barangayList,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
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
        $archived = $request->input('is_archived');
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

        if (isset($archived)) {
            $query->where('seniors.is_beneficiary_archived', $archived);
        }

        $query->orderBy('seniors.id', $order);

        $seniors = $query->paginate($perPage);

        return response()->json($seniors);
    }

    public function getBeneficiaryDataForArchive($id)
    {
        $senior = Seniors::find($id);

        if ($senior) {

            return response()->json([
                'id' => $senior->id,
                'first_name' => $senior->first_name,
                'middle_name' => $senior->middle_name,
                'last_name' => $senior->last_name,
                'suffix' => $senior->suffix,
                'osca_id' => $senior->osca_id,
            ]);
        } else {
            return response()->json(['error' => 'Beneficiary not found'], 404);
        }
    }

    public function submitAdminArchiveBeneficiary(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:seniors,id',
        ]);

        try {
            Seniors::where('id', $request->id)->update(['is_beneficiary_archived' => 1]);

            return redirect()->back()->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Beneficiary archived successfully.',
                'clearAdminArchiveBeneficiaryModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'An error occurred while archiving beneficiary.',
            ]);
        }
    }

    public function getBeneficiaryDataForRestore($id)
    {
        $senior = Seniors::find($id);

        if ($senior) {

            return response()->json([
                'id' => $senior->id,
                'first_name' => $senior->first_name,
                'middle_name' => $senior->middle_name,
                'last_name' => $senior->last_name,
                'suffix' => $senior->suffix,
                'osca_id' => $senior->osca_id,
            ]);
        } else {
            return response()->json(['error' => 'Beneficiary not found'], 404);
        }
    }

    public function submitAdminRestoreBeneficiary(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:seniors,id',
        ]);

        try {
            Seniors::where('id', $request->id)->update(['is_beneficiary_archived' => 0]);

            return redirect()->back()->with([
                'encoder-message-header' => 'Success',
                'encoder-message-body' => 'Beneficiary restored successfully.',
                'clearAdminRestoreBeneficiaryModal' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'encoder-error-message-header' => 'Failed',
                'encoder-error-message-body' => 'An error occurred while restoring the beneficiary.',
            ]);
        }
    }

    public function showAdminEncodersList()
    {
        $barangay_list = DB::table('barangay_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        $encoders = DB::table('encoder')
        ->leftJoin('barangay_list', 'barangay_list.id', '=', 'encoder.encoder_barangay_id')
        ->select(
            'encoder.id',
            'encoder.encoder_id',
            'encoder.encoder_first_name',
            'encoder.encoder_middle_name',
            'encoder.encoder_last_name',
            'encoder.encoder_suffix',
            'encoder.encoder_profile_picture',
            'encoder.encoder_address',
            'barangay_list.barangay_no',
            'encoder.encoder_contact_no',
            'encoder.encoder_email',
            'encoder.encoder_date_registered',
        )
            ->groupBy(
                'encoder.id',
                'encoder.encoder_id',
                'encoder.encoder_first_name',
                'encoder.encoder_middle_name',
                'encoder.encoder_last_name',
                'encoder.encoder_suffix',
                'encoder.encoder_profile_picture',
                'encoder.encoder_address',
                'barangay_list.barangay_no',
                'encoder.encoder_contact_no',
                'encoder.encoder_email',
                'encoder.encoder_date_registered'
            )
            ->orderBy('encoder.id', 'asc')
            ->paginate(10);

        return view('admin.admin_encoders_list', [
            'title' => 'Encoders List',
            'encoders' => $encoders,
            'barangay_list' => $barangay_list,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
        ]);
    }

    public function filterEncoders(Request $request)
    {
        $barangayId = $request->input('barangay_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchQuery = $request->input('search_query', '');
        $order = $request->input('order', 'asc');
        $perPage = 10;

        $query = DB::table('encoder')
        ->leftJoin('barangay_list', 'barangay_list.id', '=', 'encoder.encoder_barangay_id')
        ->select(
            'encoder.id',
            'encoder.encoder_id',
            'encoder.encoder_profile_picture',
            'encoder.encoder_first_name',
            'encoder.encoder_middle_name',
            'encoder.encoder_last_name',
            'encoder.encoder_suffix',
            'encoder.encoder_address',
            'barangay_list.barangay_no',
            'encoder.encoder_contact_no',
            'encoder.encoder_email',
            'encoder.encoder_date_registered',
        )
        ->groupBy('encoder.id', 'encoder.encoder_id', 'encoder.encoder_profile_picture', 'encoder.encoder_first_name','encoder.encoder_middle_name', 'encoder.encoder_last_name','encoder.encoder_suffix','encoder.encoder_address','barangay_list.barangay_no','encoder.encoder_contact_no','encoder.encoder_email', 'encoder.encoder_date_registered')
        ->orderBy('encoder.id', $order);

        if (!empty($barangayId)) {
            $query->where('encoder.encoder_barangay_id', $barangayId);
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
        $barangay_list = DB::table('barangay_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        $encoder = Encoder::leftJoin('barangay_list', 'encoder.encoder_barangay_id', '=', 'barangay_list.id')
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

        return view('admin.admin_encoder_profile', [
            'encoder' => $encoder,
            'title' => 'Profile: '. $encoder->encoder_first_name . ' ' . $encoder->encoder_last_name,
            'barangay_list' => $barangay_list,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
        ]);
    }

    public function updateAdminEncoderProfile(Request $request, $id)
    {
        $request->validate([
            'encoder_first_name' => 'required|string|max:255',
            'encoder_middle_name' => 'nullable|string|max:255',
            'encoder_last_name' => 'required|string|max:255',
            'encoder_suffix' => 'nullable|string|max:255',
            'encoder_address' => 'required|min:20|max:100',
            'encoder_barangay_id' => 'required',
            'encoder_contact_no' => 'required',
            'encoder_email' => [
                'required',
                'email',
                Rule::unique('encoder', 'encoder_email')->ignore($id)
            ],
            'g-recaptcha-response' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $secret = env('RECAPTCHA_SECRET_KEY');
                    $response = $request->input('g-recaptcha-response');
                    $remoteip = $request->ip();

                    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}&remoteip={$remoteip}");
                    $captcha_success = json_decode($verify);

                    if (!$captcha_success->success) {
                        $fail('ReCaptcha verification failed, please try again.');
                    }
                }
            ],
            'encoder_profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $encoder = Encoder::find($id);

        $originalEmail = $encoder->encoder_email;
        $newEmail = $request['encoder_email'];

        if ($newEmail !== $originalEmail) {
            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $hashedVerificationCode = Hash::make($verificationCode);
            $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

            $encoder->encoder_verification_code = $hashedVerificationCode;
            $encoder->encoder_verification_expires_at = $expirationTime;
            $encoder->encoder_verified_at = null;

            Mail::to($newEmail)->send(new EncoderChangedEmail($verificationCode, $expirationTime));
        }

        $request['encoder_contact_no'] = '+63' . $request['encoder_contact_no'];

        $encoder->encoder_first_name = $request['encoder_first_name'];
        $encoder->encoder_middle_name = $request['encoder_middle_name'];
        $encoder->encoder_last_name = $request['encoder_last_name'];
        $encoder->encoder_suffix = $request['encoder_suffix'];
        $encoder->encoder_address = $request['encoder_address'];
        $encoder->encoder_barangay_id = $request['encoder_barangay_id'];
        $encoder->encoder_contact_no = $request['encoder_contact_no'];
        $encoder->encoder_email = $request['encoder_email'];

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

        }

        $encoder->save();

        return redirect('/admin/encoders/view-encoder-profile/' . $encoder->id)->with([
            'clearAdminEditEncoderModal' => true,
            'admin-message-header' => 'Success',
            'admin-message-body' => $newEmail !== $originalEmail
                ? 'Profile updated successfully. Verification Email sent to the user.'
                : 'Profile updated successfully.',
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

        $admin_login = Admin::where('admin_email', $admin_email)->first();

        $adminUserTypeId = $admin_login ? $admin_login->admin_user_type_id : null;

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            DB::table('user_login_attempts')->insert([
                'email' => $admin_email,
                'status' => 'Throttled',
                'user_type_id' => $adminUserTypeId,
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
            DB::table('user_login_attempts')->insert([
                'email' => $admin_email,
                'status' => 'Failed',
                'user_type_id' => $adminUserTypeId,
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
            DB::table('user_login_attempts')->insert([
                'email' => $admin_email,
                'status' => 'Cancelled',
                'user_type_id' => $adminUserTypeId,
                'created_at' => now(),
            ]);

            RateLimiter::hit($this->throttleKey($request), 300);

            return back()->withErrors(['admin_password' => 'Password incorrect.'])->onlyInput('admin_email');
        }

        FacadesAuth::guard('admin')->login($admin_login);
        $request->session()->regenerate();
        $request->session()->put('admin', $admin_login);

        DB::table('user_login_attempts')->insert([
            'email' => $admin_email,
            'status' => 'Successful',
            'user_type_id' => $adminUserTypeId,
            'created_at' => now(),
        ]);

        return redirect('/admin/dashboard')->with([
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
        // dd($request->all());

        $validated = $request->validated();

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);
        unset($seniorData['income_source'], $seniorData['other_income_source_remark']);
        unset($seniorData['g-recaptcha-response']);

        do {
            $osca_id = rand(10000, 99999);
        } while (DB::table('seniors')->where('osca_id', $osca_id)->exists());

        $adminUser = auth()->guard('admin')->user();
        $adminId = $adminUser->id;
        $adminUserTypeId = $adminUser->admin_user_type_id;
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $seniorData['registration_assistant_id'] = $adminUserTypeId;
        $seniorData['registration_admin_id'] = $adminId;
        $seniorData['registration_encoder_id'] = null;
        $seniorData['registration_assistant_name'] = "{$adminFirstName} {$adminLastName}";

        $seniorData['application_assistant_id'] = $adminUserTypeId;
        $seniorData['application_admin_id'] = $adminId;
        $seniorData['application_encoder_id'] = null;
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
            $validIdFilenameToStore = $osca_id . '.' . $request->file('valid_id')->getClientOriginalExtension();
            $request->file('valid_id')->storeAs('images/senior_citizen/valid_id', $validIdFilenameToStore);
            $seniorData['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $request->validate(['profile_picture' => 'mimes:jpeg,png,bmp,tiff|max:4096']);
            $profilePictureFilenameToStore = $osca_id . '.' . $request->file('profile_picture')->getClientOriginalExtension();

            $request->file('profile_picture')->storeAs('images/senior_citizen/profile_picture', $profilePictureFilenameToStore);
            $seniorData['profile_picture'] = $profilePictureFilenameToStore;

            $thumbnailPath = 'storage/images/senior_citizen/thumbnail_profile/' . $profilePictureFilenameToStore;
            $request->file('profile_picture')->storeAs('images/senior_citizen/thumbnail_profile', $profilePictureFilenameToStore);
            $this->createThumbnail(public_path('storage/images/senior_citizen/profile_picture/' . $profilePictureFilenameToStore), public_path($thumbnailPath), 150, 150);
        }

        if ($request->hasFile('indigency')) {
            $indigencyFilenameToStore = $osca_id . '.' . $request->file('indigency')->getClientOriginalExtension();
            $request->file('indigency')->storeAs('images/senior_citizen/indigency', $indigencyFilenameToStore);
            $seniorData['indigency'] = $indigencyFilenameToStore;
        }

        if ($request->hasFile('birth_certificate')) {
            $birthCertificateFilenameToStore = $osca_id . '.' . $request->file('birth_certificate')->getClientOriginalExtension();
            $request->file('birth_certificate')->storeAs('images/senior_citizen/birth_certificate', $birthCertificateFilenameToStore);
            $seniorData['birth_certificate'] = $birthCertificateFilenameToStore;
        }

        if ($request->has('signature_data')) {
            $signatureData = base64_decode(str_replace(['data:image/png;base64,', ' '], ['', '+'], $request->input('signature_data')));
            $signatureFilename = $osca_id . '.png';
            file_put_contents(storage_path('app/public/images/senior_citizen/signatures/') . $signatureFilename, $signatureData);
            $seniorData['signature_data'] = $signatureFilename;
        }

        $seniorData['contact_no'] = '+63' . $seniorData['contact_no'];

        $generatedPassword = $seniorData['last_name'] . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 5) . '@' . rand(10, 99);
        $seniorData['password'] = Hash::make($generatedPassword);

        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $seniorData['verification_code'] = Hash::make($verificationCode);
        $seniorData['verification_expires_at'] = now()->addHour()->setTimezone('Asia/Manila');

        $seniors = Seniors::create($seniorData);

        Mail::to($seniorData['email'])->send(new SeniorRegisteredByStaff($verificationCode, $seniorData['verification_expires_at']));
        Mail::to($seniorData['email'])->send(new SeniorPassword($generatedPassword));
        Mail::to($seniorData['email'])->send(new SeniorReferenceNumber($ncsc_rrn));

        $lastSourceId = DB::table('source_list')->latest('id')->value('id');

        if ($request->input('pensioner') == 1) {
            foreach ($request->input('source', []) as $source) {
                $data = ['senior_id' => $seniors->id, 'source_id' => $source];
                if ($source == $lastSourceId) {
                    $data['other_source_remark'] = $request->input('other_source_remark');
                }
                DB::table('source')->insert($data);
            }
        }

        $lastIncomeSourceId = DB::table('where_income_source_list')->latest('id')->value('id');

        if ($request->input('permanent_source') == 1) {
            foreach ($request->input('income_source', []) as $income_source) {
                $data = ['senior_id' => $seniors->id, 'income_source_id' => $income_source];
                if ($income_source == $lastIncomeSourceId) {
                    $data['other_income_source_remark'] = $request->input('other_income_source_remark');
                }
                DB::table('income_source')->insert($data);
            }
        }

        if ($request->guardian_first_name || $request->guardian_last_name) {
            DB::table('senior_guardian')->insert([
                'senior_id' => $seniors->id,
                'guardian_first_name' => $request->guardian_first_name,
                'guardian_middle_name' => $request->guardian_middle_name,
                'guardian_last_name' => $request->guardian_last_name,
                'guardian_suffix' => $request->guardian_suffix,
                'guardian_relationship_id' => $request->guardian_relationship_id,
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
        $changes = "Admin $adminFirstName $adminLastName added {$seniorData['first_name']} {$seniorData['middle_name']} {$seniorData['last_name']} with Osca ID {$osca_id} as Beneficiary";

        DB::table('activity_log')->insert([
            'activity' => 'Add Beneficiary',
            'activity_type_id' => 1,
            'changes' => $changes,
            'status' => $status,
            'activity_user_type_id' => 3,
            'activity_encoder_id' => null,
            'activity_admin_id' => $adminId,
            'created_at' => now(),
        ]);

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

        $process = new Process(['C:\Program Files\nodejs\node.exe', base_path('resources/js/updateSeniorOnBlockchain.mjs'), $senior->id]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return back()->with([
            'admin-message-header' => 'Update Successful',
            'admin-message-body' => 'The beneficiary details have been successfully updated, including blockchain data.',
        ]);
    }

    public function showAdminPensionDistributionList()
    {
        $barangayList = DB::table('barangay_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        $pension_distributions = DB::table('pension_distribution_list')
        ->leftJoin('barangay_list', 'pension_distribution_list.barangay_id', '=', 'barangay_list.id')
        ->leftJoin('user_type_list', 'pension_distribution_list.pension_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'pension_distribution_list.pension_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'pension_distribution_list.pension_admin_id', '=', 'admin.id')
        ->select(
            'pension_distribution_list.*',
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
            ->orderBy('pension_distribution_list.id', 'asc')
            ->paginate(10);

        return view('admin.admin_pension_distribution_list', [
            'title' => 'Pension Distribution List',
            'barangayList' => $barangayList,
            'pension_distributions' => $pension_distributions,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
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
            ->leftJoin('user_type_list', 'pension_distribution_list.pension_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'pension_distribution_list.pension_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'pension_distribution_list.pension_admin_id', '=', 'admin.id')
        ->select(
            'pension_distribution_list.*',
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

    public function submitAdminAddPensionDistribution(Request $request)
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

        $adminUser = auth()->guard('admin')->user();
        $adminId = $adminUser->id;
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

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
                    'pension_user_type_id' => $adminUser->admin_user_type_id,
                    'pension_admin_id' => $adminId,
                    'pension_encoder_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('activity_log')->insert([
                    'activity' => 'Add Pension Distribution Program',
                    'activity_type_id' => 1,
                    'changes' => "Admin {$adminFirstName} {$adminLastName} added Pension Distribution Program for Barangay {$barangayNo} on {$distributionDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 3,
                    'activity_encoder_id' => null,
                    'activity_admin_id' => $adminId,
                    'created_at' => now(),
                ]);
            }

            DB::table('pension_distribution_list')->insert($programs);

            return redirect()->back()->with([
                'admin-message-header' => 'Success',
                'admin-message-body' => 'Pension distribution added successfully.',
                'clearAdminAddPensionDistributionModal' => true,
            ]);
        } catch (\Exception $e) {
            DB::table('activity_log')->insert([
                'activity' => 'Add Pension Distribution Program',
                'activity_type_id' => 1,
                'changes' => "Admin {$adminFirstName} {$adminLastName} attempted to add Pension Distribution Programs.",
                'status' => 'Cancelled',
                'activity_user_type_id' => 3,
                'activity_encoder_id' => null,
                'activity_admin_id' => $adminId,
                'created_at' => now(),
            ]);

            return redirect()->back()->withErrors([
                'admin-message-header' => 'Error',
                'admin-message-body' => 'Failed to add pension distribution. Please try again.',
            ]);
        }
    }

    public function submitAdminEditPensionDistribution(Request $request)
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

        $adminUser = auth()->guard('admin')->user();
        $adminUserTypeId = $adminUser->admin_user_type_id;
        $adminId = $adminUser->id;

        $pensionId = $validatedData['id'];

        $program = [
            'barangay_id' => $validatedData['edit_barangay_id'],
            'venue' => $validatedData['edit_venue'],
            'date_of_distribution' => $validatedData['edit_date_of_distribution'],
            'end_time' => $validatedData['edit_end_time'],
            'pension_user_type_id' => $adminUserTypeId,
            'pension_admin_id' => $adminId,
            'pension_encoder_id' => null,
        ];

        $affectedRows = DB::table('pension_distribution_list')
        ->where('id', $pensionId)
            ->update($program);

        if ($affectedRows === 0) {
            return redirect()->back()->with([
                'admin-error-message-header' => 'Update Unsuccessful',
                'admin-error-message-body' => 'No changes were made to the pension distribution program.',
                'clearAdminEditPensionDistributionModal' => true,
            ]);
        }

        DB::table('pension_distribution_list')
        ->where('id', $pensionId)
            ->update($program);

        return redirect()->back()->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Pension distribution updated successfully.',
            'clearAdminEditPensionDistributionModal' => true,
        ]);
    }

    public function submitAdminDeletePensionDistribution(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pension_distribution_list,id',
        ]);

        $pensionDistribution = PensionDistribution::find($request->id);

        if ($pensionDistribution) {
            $barangay = Barangay::find($pensionDistribution->barangay_id);
            $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';
            $distributionDate = Carbon::parse($pensionDistribution->date_of_distribution)->translatedFormat('F j, Y h:i A');

            $adminUser = auth()->guard('admin')->user();
            $adminId = $adminUser->id;
            $adminFirstName = $adminUser->admin_first_name;
            $adminLastName = $adminUser->admin_last_name;

            try {
                $pensionDistribution->delete();

                DB::table('activity_log')->insert([
                    'activity' => 'Delete Pension Distribution Program',
                    'activity_type_id' => 3,
                    'changes' => "Admin {$adminFirstName} {$adminLastName} deleted Pension Distribution Program for Barangay {$barangayNo} scheduled on {$distributionDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 3,
                    'activity_encoder_id' => null,
                    'activity_admin_id' => $adminId,
                    'created_at' => now(),
                ]);

                return redirect()->back()->with([
                    'admin-message-header' => 'Success',
                    'admin-message-body' => 'Pension distribution deleted successfully.',
                    'clearAdminDeletePensionDistributionModal' => true,
                ]);
            } catch (\Exception $e) {
                DB::table('activity_log')->insert([
                    'activity' => 'Delete Pension Distribution Program',
                    'activity_type_id' => 3,
                    'changes' => "Admin {$adminFirstName} {$adminLastName} attempted to delete Pension Distribution Program for Barangay {$barangayNo} scheduled on {$distributionDate}",
                    'status' => 'Cancelled',
                    'activity_user_type_id' => 3,
                    'activity_encoder_id' => null,
                    'activity_admin_id' => $adminId,
                    'created_at' => now(),
                ]);

                return redirect()->back()->withErrors([
                    'admin-message-header' => 'Error',
                    'admin-message-body' => 'Failed to delete pension distribution. Please try again.',
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

    public function showAdminEventsList()
    {
        $barangayList = DB::table('barangay_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
            ->where('id', $adminUser->admin_user_type_id)
            ->value('user_type');

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

        return view('admin.admin_events_list', [
            'title' => 'Events List',
            'barangayList' => $barangayList,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
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

    public function submitAdminDeleteEvent(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events_list,id',
        ]);

        $eventId = $request->id;
        $event = Events::find($eventId);

        if ($event) {
            $eventTitle = $event->title;
            $eventDate = Carbon::parse($event->date_of_event)->translatedFormat('F j, Y h:i A');

            $adminUser = auth()->guard('admin')->user();
            $adminId = $adminUser->id;
            $adminFirstName = $adminUser->admin_first_name;
            $adminLastName = $adminUser->admin_last_name;

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
                    'changes' => "Admin {$adminFirstName} {$adminLastName} deleted the event titled '{$eventTitle}' scheduled on {$eventDate}",
                    'status' => 'Successful',
                    'activity_user_type_id' => 2,
                    'activity_admin_id' => $adminId,
                    'activity_encoder_id' => null,
                    'created_at' => now(),
                ]);

                DB::commit();

                return redirect()->back()->with([
                    'admin-message-header' => 'Success',
                    'admin-message-body' => 'Event and associated images deleted successfully.',
                    'clearAdminDeleteEventModal' => true,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                DB::table('activity_log')->insert([
                    'activity' => 'Delete Event',
                    'activity_type_id' => 3,
                    'changes' => "Admin {$adminFirstName} {$adminLastName} attempted to delete the event titled '{$eventTitle}' scheduled on {$eventDate}",
                    'status' => 'Cancelled',
                    'activity_user_type_id' => 2,
                    'activity_admin_id' => $adminId,
                    'activity_encoder_id' => null,
                    'created_at' => now(),
                ]);

                return redirect()->back()->with([
                    'admin-error-message-header' => 'Deletion Failed',
                    'admin-error-message-body' => 'An error occurred while deleting the event. Please try again.',
                ]);
            }
        }

        return redirect()->back()->with([
            'admin-error-message-header' => 'Event Not Found',
            'admin-error-message-body' => 'The requested event does not exist.',
        ]);
    }

    public function showAdminAddEvent()
    {

        $barangayList = DB::table('barangay_list')->get();

        return view('admin.admin_add_event', [
            'title' => 'Add Event',
            'barangayList' => $barangayList,
        ]);
    }

    public function submitAdminAddEvent(Request $request)
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

        $adminUser = auth()->guard('admin')->user();
        $adminUserTypeId = $adminUser->admin_user_type_id;
        $adminId = $adminUser->id;
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

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
            'event_user_type_id' => $adminUserTypeId,
            'event_encoder_id' => null,
            'event_admin_id' => $adminId,
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
            'changes' => "Admin {$adminFirstName} {$adminLastName} added event titled '{$validatedData['title']}' for {$barangayNo} on {$event->event_date->toFormattedDateString()}",
            'status' => 'Successful',
            'activity_user_type_id' => 2,
            'activity_admin_id' => $adminId,
            'activity_encoder_id' => null,
            'created_at' => now(),
        ]);

        return redirect()->route('admin-add-event')->with([
            'admin-message-header' => 'Success',
            'admin-message-body' => 'Event created successfully.',
        ]);
    }

    public function showAdminEditEvent($id)
    {
        $events = Events::findOrFail($id);

        $barangayList = DB::table('barangay_list')->get();

        $event_images = DB::table('events_images')
            ->leftJoin('events_list', 'events_images.event_id', '=', 'events_list.id')
            ->where('events_list.id', $id)
            ->select('events_images.image', 'events_images.is_highlighted', 'events_images.event_id')
            ->get();

        return view('admin.admin_edit_event', [
            'title' => 'Edit Event',
            'event' => $events,
            'event_images' => $event_images,
            'barangayList' => $barangayList,
        ]);
    }

    public function showAdminLoginAttempts()
    {
        $user_login_attempts = DB::table('user_login_attempts')
        ->leftJoin('user_type_list', 'user_login_attempts.user_type_id', '=', 'user_type_list.id')
        ->select(
            'user_login_attempts.*',
            'user_type_list.user_type',
        )
            ->orderBy('user_login_attempts.id', 'asc')
            ->paginate(10);

        $user_type_list = DB::table('user_type_list')->get();
        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        return view('admin.admin_sign_in_history', [
            'title' => 'Sign In History',
            'user_type_lists' => $user_type_list,
            'user_login_attempts' => $user_login_attempts,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
        ]);
    }

    public function filterAdminLoginAttempts(Request $request)
    {
        $userTypeId = $request->input('user_type_id');
        $statusIds = $request->input('status_ids', []);
        $searchQuery = $request->input('search_query', '');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderDirection = $request->input('order', 'desc');
        $perPage = 10;

        $query = DB::table('user_login_attempts')
        ->leftJoin('user_type_list', 'user_login_attempts.user_type_id', '=', 'user_type_list.id')
        ->select(
            'user_login_attempts.*',
            'user_type_list.user_type',
        );

        if ($userTypeId === 'null') {
            $query->whereNull('user_login_attempts.user_type_id');
        } elseif (!empty($userTypeId) && $userTypeId !== 'all') {
            $query->where('user_login_attempts.user_type_id', $userTypeId);
        }

        if (!empty($statusIds)) {
            $query->whereIn('user_login_attempts.status', $statusIds);
        }

        if ($startDate) {
            $query->whereDate('user_login_attempts.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('user_login_attempts.created_at', '<=', $endDate);
        }

        if ($startDate || $endDate) {
            $query->orderBy('user_login_attempts.created_at', $orderDirection);
        } else {
            $query->orderBy('user_login_attempts.id', $orderDirection);
        }

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(user_login_attempts.email) LIKE ?", ['%' . $term . '%']);
                }
            });
        }

        $user_login_attempts = $query->paginate($perPage);

        return response()->json($user_login_attempts);
    }

    public function showAdminActivityLog()
    {
        $activity_logs = DB::table('activity_log')
        ->leftJoin('activity_types', 'activity_log.activity_type_id', '=', 'activity_types.id')
        ->leftJoin('user_type_list', 'activity_log.activity_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'activity_log.activity_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'activity_log.activity_admin_id', '=', 'admin.id')
        ->select(
            'activity_log.*',
            'activity_types.activity_type',
            'user_type_list.user_type',
            'encoder.encoder_first_name',
            'encoder.encoder_last_name',
            'encoder_profile_picture',
            'admin.admin_first_name',
            'admin.admin_last_name',
            'admin_profile_picture',
        )
            ->orderBy('activity_log.id', 'asc')
            ->paginate(10);

        $activity_types = DB::table('activity_types')->get();

        $user_type_list = DB::table('user_type_list')->get();

        $adminUser = auth()->guard('admin')->user();
        $adminFirstName = $adminUser->admin_first_name;
        $adminLastName = $adminUser->admin_last_name;

        $userRole = DB::table('user_type_list')
        ->where('id', $adminUser->admin_user_type_id)
        ->value('user_type');

        return view('admin.admin_activity_log', [
            'title' => 'Activity Log',
            'activity_types' => $activity_types,
            'user_type_lists' => $user_type_list,
            'activity_logs' => $activity_logs,
            'adminFirstName' => $adminFirstName,
            'adminLastName' => $adminLastName,
            'userRole' => $userRole,
        ]);
    }

    public function filterAdminActivityLog(Request $request)
    {
        $userTypeId = $request->input('user_type_id');
        $activityIds = $request->input('activity_ids', []);
        $statusIds = $request->input('status_ids', []);
        $searchQuery = $request->input('search_query', '');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $orderDirection = $request->input('order', 'desc');
        $perPage = 10;

        $query = DB::table('activity_log')
        ->leftJoin('activity_types', 'activity_log.activity_type_id', '=', 'activity_types.id')
        ->leftJoin('user_type_list', 'activity_log.activity_user_type_id', '=', 'user_type_list.id')
        ->leftJoin('encoder', 'activity_log.activity_encoder_id', '=', 'encoder.id')
        ->leftJoin('admin', 'activity_log.activity_admin_id', '=', 'admin.id')
        ->select(
            'activity_log.*',
            'activity_types.activity_type',
            'user_type_list.user_type',
            'encoder.encoder_first_name',
            'encoder.encoder_last_name',
            'encoder_profile_picture',
            'admin.admin_first_name',
            'admin.admin_last_name',
            'admin_profile_picture'
        );

        if (!empty($userTypeId)) {
            $query->where('activity_log.activity_user_type_id', $userTypeId);
        }

        if (!empty($activityIds)) {
            $query->whereIn('activity_log.activity_type_id', $activityIds);
        }

        if (!empty($statusIds)) {
            $query->whereIn('activity_log.status', $statusIds);
        }

        if ($startDate) {
            $query->whereDate('activity_log.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('activity_log.created_at', '<=', $endDate);
        }

        if ($startDate || $endDate) {
            $query->orderBy('activity_log.created_at', $orderDirection);
        } else {
            $query->orderBy('activity_log.id', $orderDirection);
        }

        if (!empty($searchQuery)) {
            $terms = array_filter(explode(' ', strtolower($searchQuery)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->whereRaw("LOWER(activity_log.activity) LIKE ?", ['%' . $term . '%'])
                        ->orWhereRaw("LOWER(CONCAT(encoder.encoder_first_name, ' ', encoder.encoder_last_name)) LIKE ?", ['%' . $term . '%'])
                        ->orWhereRaw("LOWER(CONCAT(admin.admin_first_name, ' ', admin.admin_last_name)) LIKE ?", ['%' . $term . '%']);
                }
            });
        }

        $activity_logs = $query->paginate($perPage);

        return response()->json($activity_logs);
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
                $originalEmail = $admin->admin_email;
                $newEmail = $updatedData['admin_email'];

                if ($newEmail !== $originalEmail) {
                    $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $hashedVerificationCode = Hash::make($verificationCode);
                    $expirationTime = now()->addHour()->setTimezone('Asia/Manila');

                    $admin->admin_verification_code = $hashedVerificationCode;
                    $admin->admin_verification_expires_at = $expirationTime;
                    $admin->admin_verified_at = null;

                    Mail::to($newEmail)->send(new AdminChangedEmail($verificationCode, $expirationTime));
                }
                
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
