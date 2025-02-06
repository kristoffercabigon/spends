<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreSeniorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "osca_id" => ['nullable', 'min:4', 'max:6', Rule::unique('seniors', 'osca_id')],
            "first_name" => [
                'required',
                'max:64',
                'regex:/^[a-zA-Z\s\-.\'áéíóúàèùãõç]+$/'
            ],
            "last_name" => [
                'required',
                'max:32',
                'regex:/^[a-zA-Z\s\-.\'áéíóúàèùãõç]+$/'
            ],
            "middle_name" => [
                'nullable',
                'max:32',
                'regex:/^[a-zA-Z\s\-.\'áéíóúàèùãõç]+$/'
            ],
            "suffix" => [
                'nullable',
                'max:10',
                'regex:/^[a-zA-Z\s\-.\'áéíóúàèùãõç]+$/'
            ],
            "birthdate" => ['required', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 60) {
                    $fail('The age must be 60 years old or above.');
                }
            }],
            "age" => ['required'],
            "birthplace" => [
                'required',
                'max:32',
                'regex:/^[a-zA-Z\s\-.\']+$/'
            ],
            "sex_id" => ['required'],
            "civil_status_id" => ['required'],
            "contact_no" => [
                'required',
                'regex:/^9\d{9}$/'
            ],
            "address" => ['required', 'min:10', 'max:100', 'regex:/\bCaloocan\b/i'],
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
            "other_arrangement_remark" => 'required_if:type_of_living_arrangement,5|max:32',
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
            "guardian_first_name" => 'nullable|max:64',
            "guardian_middle_name" => 'nullable|max:32',
            "guardian_last_name" => 'nullable|max:32',
            "guardian_suffix" => 'nullable|max:32',
            "guardian_relationship_id" => 'nullable|string|max:255',
            "guardian_contact_no" => [
                'nullable',
                'regex:/^9\d{9}$/'
            ],
            "relative_name.*" => 'nullable|string|max:100',
            "relative_relationship.*" => 'nullable|string|max:255',
            "relative_age.*" => 'nullable|integer|min:0',
            "relative_civil_status.*" => 'nullable|string|max:255',
            "relative_occupation.*" => 'nullable|string|max:255',
            "relative_income.*" => 'nullable|string|max:255',
            "signature" => 'required_if:signature_data,null|mimes:jpeg,png,bmp,tiff|max:4096',
            "signature_data" => ['required_if:signature,null'],
            "confirm-checkbox" => ['required'],
            "g-recaptcha-response" => ['required', function ($attribute, $value, $fail) {
                $secret = env('RECAPTCHA_SECRET_KEY');
                $response = request()->input('g-recaptcha-response');
                $remoteip = request()->ip();
                $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}&remoteip={$remoteip}");
                $captcha_success = json_decode($verify);
                if (!$captcha_success->success) {
                    $fail('ReCaptcha verification failed, please try again.');
                }
            }],
        ];
    }

    public function attributes()
    {
        return [
            'osca_id' => 'OSCA ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'suffix' => 'Suffix',
            'birthdate' => 'Birthdate',
            'age' => 'Age',
            'birthplace' => 'Birthplace',
            'sex_id' => 'Sex',
            'civil_status_id' => 'Civil Status',
            'contact_no' => 'Contact Number',
            'address' => 'Address',
            'barangay_id' => 'Barangay',
            'email' => 'Email',
            'password' => 'Password',
            'valid_id' => 'Valid ID',
            'profile_picture' => 'Profile Picture',
            'indigency' => 'Indigency Document',
            'birth_certificate' => 'Birth Certificate',
            'type_of_living_arrangement' => 'Living Arrangement',
            'other_arrangement_remark' => 'Other Arrangement Remark',
            'pensioner' => 'Pensioner Status',
            'if_pensioner_yes' => 'Pension Details',
            'source' => 'Source of Pension',
            'other_source_remark' => 'Other Source Remark',
            'permanent_source' => 'Permanent Source of Income',
            'income_source' => 'Income Source',
            'if_permanent_yes_income' => 'Permanent Income Details',
            'has_illness' => 'Illness Status',
            'if_illness_yes' => 'Illness Details',
            'has_disability' => 'Disability Status',
            'if_disability_yes' => 'Disability Details',
            'guardian_first_name' => 'Guardian First Name',
            'guardian_middle_name' => 'Guardian Middle Name',
            'guardian_last_name' => 'Guardian Last Name',
            'guardian_suffix' => 'Guardian Suffix',
            'guardian_relationship_id' => 'Guardian Relationship',
            'guardian_contact_no' => 'Guardian Contact Number',
            'relative_name.*' => 'Relative Name',
            'relative_relationship.*' => 'Relative Relationship',
            'relative_age.*' => 'Relative Age',
            'relative_civil_status.*' => 'Relative Civil Status',
            'relative_occupation.*' => 'Relative Occupation',
            'relative_income.*' => 'Relative Income',
            'signature' => 'Signature',
            'signature_data' => 'Signature Data',
            'confirm-checkbox' => 'Agreement Checkbox',
            'g-recaptcha-response' => 'ReCaptcha Verification',
        ];
    }

    public function messages()
    {
        return [
            'osca_id.unique' => 'This OSCA ID is already registered.',
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name cannot exceed 64 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.max' => 'Last name cannot exceed 32 characters.',
            'birthdate.required' => 'Birthdate is required to calculate your age.',
            'age.required' => 'Specify your birthdate to show your age.',
            'birthplace.required' => 'Birthplace is required.',
            'sex_id.required' => 'Sex is required.',
            'civil_status_id.required' => 'Civil status is required.',
            'contact_no.required' => 'Contact number is required.',
            'address.required' => 'Address is required.',
            'address.min' => 'Full address needed, press the (i) icon to see the needed info.',
            'address.max' => 'Address cannot exceed 100 characters.',
            'address.regex' => 'Please include Caloocan city in your address.',
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
            'indigency.required' => 'Indigency document is required.',
            'indigency.mimes' => 'Indigency must be a file of type: jpeg, png, bmp, tiff.',
            'indigency.max' => 'Indigency must not exceed 4096 kilobytes.',
            'birth_certificate.required' => 'Birth certificate is required.',
            'birth_certificate.mimes' => 'Birth certificate must be a file of type: jpeg, png, bmp, tiff.',
            'birth_certificate.max' => 'Birth certificate must not exceed 4096 kilobytes.',
            'type_of_living_arrangement.required' => 'Type of living arrangement is required.',
            'pensioner.required' => 'Pensioner status is required.',
            'permanent_source.required' => 'Income status is required.',
            'has_illness.required' => 'Illness status is required.',
            'has_disability.required' => 'Disability status is required.',
            'signature_data.required' => 'Signature is required.',
            'confirm-checkbox.required' => 'You must agree to the terms.',
            'g-recaptcha-response.required' => 'ReCaptcha verification is required.',
        ];
    }
}
