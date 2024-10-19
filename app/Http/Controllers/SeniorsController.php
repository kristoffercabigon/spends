<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;
use Carbon\Carbon;

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
        $citizenship = DB::table('citizenship')->get();
        $civil_status = DB::table('civil_status')->get();
        $barangay = DB::table('barangay')->get();

        return view('seniors.create')->with([
            'title' => 'SPENDS: Register',
            'sources' => $sources,
            'arrangement_lists' => $arrangement_lists,
            'sexes' => $sexes,
            'citizenship' => $citizenship,
            'civil_status' => $civil_status,
            'barangay' => $barangay
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => ['required', 'min:4', 'max:60'],
            "last_name" => ['required', 'min:4', 'max:30'],
            "middle_name" => ['nullable'],
            "suffix" => ['nullable'],
            "citizenship_id" => ['required'],
            "birthdate" => ['required', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->age < 60) {
                    $fail('The age must be 60 years old or above.');
                }
            }],
            "age" => ['required'],
            "birthplace" => ['required'],
            "sex_id" => ['required'],
            "civil_status_id" => ['required'],
            "address" => ['required'],
            "barangay_id" => ['required'],
            "email" => ['required', 'email', Rule::unique('seniors', 'email')],
            "password" => 'required|confirmed|min:8|max:32',
            "valid_id" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            "profile_picture" => 'nullable|mimes:jpeg,png,bmp,tiff|max:4096',
            "indigency" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            "type_of_living_arrangement" => ['required'],
            "other_arrangement_remark" => 'required_if:type_of_living_arrangement,5',
            "pensioner" => ['required'],
            "if_pensioner_yes" => 'required_if:pensioner,1',
            "source" => ['required', 'array'],
            "source.*" => ['required', 'integer'],
            'other_source_remark' => 'required_if:source.*,4',
            "permanent_source" => ['required'],
            "if_permanent_yes" => 'required_if:permanent_source,1',
            "regular_support" => ['required'],
            "if_cash" => 'required_if:regular_support,1',
            "specific_support" => 'required_if:regular_support,1',
            "has_illness" => ['required'],
            "if_illness_yes" => 'required_if:has_illness,1',
            "hospitalized_6" => ['required'],
            "relative_name.*" => 'nullable|string|max:255',
            "relative_relationship.*" => 'nullable|string|max:255',
            "relative_age.*" => 'nullable|integer|min:0',
            "relative_civil_status.*" => 'nullable|string|max:255',
            "relative_occupation.*" => 'nullable|string|max:255',
            "relative_income.*" => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('valid_id')) {
            $validIdFilename = pathinfo($request->file('valid_id')->getClientOriginalName(), PATHINFO_FILENAME);
            $validIdExtension = $request->file('valid_id')->getClientOriginalExtension();
            $validIdFilenameToStore = $validIdFilename . '_' . time() . '.' . $validIdExtension;
            $request->file('valid_id')->storeAs('public/images/valid_id', $validIdFilenameToStore);
            $validated['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $profilePictureFilename = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
            $profilePictureExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $profilePictureFilenameToStore = $profilePictureFilename . '_' . time() . '.' . $profilePictureExtension;
            $request->file('profile_picture')->storeAs('public/images/profile_picture', $profilePictureFilenameToStore);
            $validated['profile_picture'] = $profilePictureFilenameToStore;
        }

        if ($request->hasFile('indigency')) {
            $indigencyFilename = pathinfo($request->file('indigency')->getClientOriginalName(), PATHINFO_FILENAME);
            $indigencyExtension = $request->file('indigency')->getClientOriginalExtension();
            $indigencyFilenameToStore = $indigencyFilename . '_' . time() . '.' . $indigencyExtension;
            $request->file('indigency')->storeAs('public/images/indigency', $indigencyFilenameToStore);
            $validated['indigency'] = $indigencyFilenameToStore;
        }

        $seniorData = $validated;
        unset($seniorData['source'], $seniorData['other_source_remark']);

        $seniorData['password'] = Hash::make($seniorData['password']);

        $seniors = Seniors::create($seniorData);

        foreach ($request->input('source') as $source) {
            $data = [
                'senior_id' => $seniors->id,
                'source_id' => $source,
            ];

            if ($source == 4) {
                $data['other_source_remark'] = $request->input('other_source_remark');
            }

            DB::table('source')->insert($data);
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

        FacadesAuth::login($seniors);

        return redirect('/')->with('message', 'New Senior was added successfully!');
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
