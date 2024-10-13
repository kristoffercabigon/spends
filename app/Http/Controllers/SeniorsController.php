<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;

class SeniorsController extends Controller
{
    public function index()
    {
        $data = array("seniors" => DB::table('seniors')->orderBy('created_at', 'desc')->paginate(10));
        return view('seniors.index', $data)->with('title', 'SPENDS: Home ');
    }

    public function create()
    {
        return view('seniors.create')->with('title', 'SPENDS: Register ');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "middle_name" => ['required', 'min:4'],
            "suffix" => ['required', 'min:4'],
            "birthdate" => ['required'],
            "age" => ['required'],
            "birthplace" => ['required'],
            "sex" => ['required'],
            "civil_status" => ['required'],
            "employment_status" => ['required'],
            "religion" => ['required'],
            "blood_type" => ['required'],
            "address" => ['required'],
            "barangay" => ['required'],
            "telephone_number" => ['required'],
            "mobile_number" => ['required'],
            "existing_email" => ['required'],
            "gsis_number" => ['required'],
            "sss_number" => ['required'],
            "tin_number" => ['required'],
            "philhealth_number" => ['required'],
            "email" => ['required', 'email', Rule::unique('seniors', 'email')],
            "password" => 'required|confirmed|min:6',
            "valid_id" => 'nullable|mimes:jpeg,png,bmp,tiff|max:4096',
            "profile_picture" => 'nullable|mimes:jpeg,png,bmp,tiff|max:4096',
        ]);

        // dd($request->all());

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('valid_id')) {
            $validIdFilename = pathinfo($request->file('valid_id')->getClientOriginalName(), PATHINFO_FILENAME);
            $validIdExtension = $request->file('valid_id')->getClientOriginalExtension();
            $validIdFilenameToStore = $validIdFilename . '_' . time() . '.' . $validIdExtension;

            $request->file('valid_id')->storeAs('public/images/valid_id', $validIdFilenameToStore);
            $validated['valid_id'] = $validIdFilenameToStore;
        }

        if ($request->hasFile('profile_picture')) {
            $pensionerFilename = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
            $pensionerExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $pensionerFilenameToStore = $pensionerFilename . '_' . time() . '.' . $pensionerExtension;

            $request->file('profile_picture')->storeAs('public/images/profile_picture', $pensionerFilenameToStore);
            $validated['profile_picture'] = $pensionerFilenameToStore;
        }

        $seniors = Seniors::create($validated);

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
