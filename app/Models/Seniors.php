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
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'birthdate',
        'age',
        'citizenship_id',
        'birthplace',
        'sex_id',
        'civil_status_id',
        'address',
        'barangay_id',
        'email',
        'password',
        'valid_id',
        'profile_picture',
        'indigency',
        'hospitalized_6',
        'type_of_living_arrangement',
        'regular_support',
        'other_arrangement_remark',
        'pensioner',
        'if_pensioner_yes',
        'source',
        'other_source_remark',
        'permanent_source',
        'if_permanent_yes',
        'if_cash',
        'specific_support',
        'has_illness',
        'if_illness_yes',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
