<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsImages extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;

    protected $guarded = [];

    protected $table = 'events_images';

    protected $fillable = [
        'event_id',
        'image',
        'is_highlighted'
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
