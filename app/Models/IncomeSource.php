<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory; 

    protected $guarded = [];

    protected $table = 'income_source';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'token_expiration' => 'datetime',
        'verified_at' => 'datetime',
        'verification_expires_at' => 'datetime',
        'password' => 'hashed',
    ];
}
