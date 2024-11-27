<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class StoreAddBeneficiary extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "first_name" => ['required', 'min:4', 'max:60'],
            "last_name" => ['required', 'min:4', 'max:30'],
            "middle_name" => ['nullable'],
            "suffix" => ['nullable'],
            "birthdate" => ['required', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 60) {
                    $fail('The age must be 60 years old or above.');
                }
            }],
            "age" => ['required'],
            "birthplace" => ['required'],
            "sex_id" => ['required'],
            "civil_status_id" => ['required'],
            "contact_no" => ['required'],
            "address" => ['required', 'min:20', 'max:100', 'regex:/\bCaloocan\b/i'],
            "barangay_id" => ['required'],
            "email" => ['required', 'email', Rule::unique('seniors', 'email')],
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

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 4 characters.',
            'first_name.max' => 'First name cannot exceed 60 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 4 characters.',
            'last_name.max' => 'Last name cannot exceed 30 characters.',
            'birthdate.required' => 'Birthdate is required to calculate the age.',
            'age.required' => 'Specify the birthdate to show the age.',
            'birthplace.required' => 'Birthplace is required.',
            'sex_id.required' => 'Sex is required.',
            'civil_status_id.required' => 'Civil status is required.',
            'contact_no.required' => 'Contact number is required.',
            'address.required' => 'Address is required.',
            'address.min' => 'Full address needed, press the (i) icon to see the needed info.',
            'address.max' => 'Address cannot exceed 100 characters.',
            'address.regex' => 'Please include Caloocan city in the address.',
            'barangay_id.required' => 'Barangay is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
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
            'g-recaptcha-response.required' => 'ReCaptcha verification is required.',
        ];
    }
}
