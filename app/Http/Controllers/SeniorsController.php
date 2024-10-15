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

        $sexes = DB::table('sex')->get();
        $citizenship = DB::table('citizenship')->get();
        $civil_status = DB::table('civil_status')->get();
        $barangay = DB::table('barangay')->get();  

        return view('seniors.create')->with([
            'title' => 'SPENDS: Register',
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
            "birthdate" => ['required', function ($age, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 60) {
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
            "password" => 'required|confirmed|min:8|max:16',
            "valid_id" => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
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
