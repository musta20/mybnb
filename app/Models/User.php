<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory,HasUlids,Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'date_of_birth',
        'phone_number',
        'profile_picture',
        'about_me',
        'languages',
        'response_time',
        'response_rate',
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
     * Get the listings owned by the user (host).
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'host_id');
    }

    /**
     * Get the bookings made by the user (guest).
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'guest_id');
    }

    /**
     * Get the bookings made by the user (guest).
     */
    public function hostbookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, Listing::class, 'host_id', 'listing_id', 'id', 'id');
        // return $this->hasMany(Booking::class);
    }

    public function wichListings(): BelongsToMany
    {
        return $this->belongsToMany(Listing::class, 'wish_lists')->wherePivotNull('deleted_at');
    }

    /**
     * Get the reviews written by the user (guest).
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class, 'guest_id');
    }

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
