<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, HasUlids ,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'address',
        'city',
        'latitude',
        'longitude',
        'number_of_guests',
        'number_of_bedrooms',
        'number_of_bathrooms',
        'amenities',
        'price_per_night',
        'host_id',
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    /**
     * Get the host (user) who owns the listing.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get the bookings for the listing.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews for the listing.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(ListingMedia::class);
    }
}
