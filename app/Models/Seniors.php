<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seniors extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'Seniors';

    protected $fillable = [
        'osca_id',
        'ncsc_rrn',
        'user_type_id',
        'application_status_id',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'birthdate',
        'age',
        'birthplace',
        'sex_id',
        'civil_status_id',
        'contact_no',
        'address',
        'barangay_id',
        'email',
        'password',
        'valid_id',
        'profile_picture',
        'indigency',
        'birth_certificate',
        'signature_data',
        'type_of_living_arrangement',
        'other_arrangement_remark',
        'pensioner',
        'if_pensioner_yes',
        'permanent_source',
        'if_permanent_yes',
        'if_permanent_yes_income',
        'has_illness',
        'if_illness_yes',
        'has_disability',
        'if_disability_yes',
        'date_applied',
        'verification_code',
        'verified_at',
        'verification_expires_at',
        'token',
        'expiration',
        'date_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expiration' => 'datetime',
            'verified_at' => 'datetime',
            'verification_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
