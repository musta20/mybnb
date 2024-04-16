<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{

    use SoftDeletes,HasFactory,HasUlids;

    protected $fillable = [
        'listing_id',
        'guest_id',
        'rating',
        'comment',
    ];

 
    /**
     * Get the listing that the review belongs to.
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    /**
     * Get the guest (user) who wrote the review.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }



}
