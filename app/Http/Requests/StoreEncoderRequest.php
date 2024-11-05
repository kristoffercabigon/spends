<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEncoderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "encoder_first_name" => ['required', 'min:4', 'max:60'],
            "encoder_last_name" => ['required', 'min:4', 'max:30'],
            "encoder_middle_name" => ['nullable'],
            "encoder_suffix" => ['nullable'],
            "encoder_email" => ['required', 'email', Rule::unique('encoder', 'encoder_email')],
            "encoder_password" => [
                'required',
                'min:8',
                'max:32',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
                'confirmed'
            ],
            "encoder_profile_picture" => 'nullable|mimes:jpeg,png,bmp,tiff|max:4096',
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
            'encoder_first_name.required' => 'First name is required.',
            'encoder_first_name.min' => 'First name must be at least 4 characters.',
            'encoder_first_name.max' => 'First name cannot exceed 60 characters.',
            'encoder_last_name.required' => 'Last name is required.',
            'encoder_last_name.min' => 'Last name must be at least 4 characters.',
            'encoder_last_name.max' => 'Last name cannot exceed 30 characters.',
            'encoder_email.required' => 'Email is required.',
            'encoder_email.email' => 'Email must be a valid email address.',
            'encoder_email.unique' => 'This email is already registered.',
            'encoder_password.required' => 'Password is required.',
            'encoder_password.min' => 'Password must be at least 8 characters.',
            'encoder_password.max' => 'Password cannot exceed 32 characters.',
            'encoder_password.regex' => 'Include 1 uppercase and lowercase letter and 1 special character.',
            'encoder_password.confirmed' => 'Password confirmation does not match.',
            'g-recaptcha-response.required' => 'ReCaptcha verification is required.',
        ];
    }
}
