<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;

    protected $guarded = [];

    protected $table = 'events_list';

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'video',
        'is_featured',
        'barangay_id',
        'event_user_type_id',
        'event_encoder_id',
        'event_admin_id'
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
