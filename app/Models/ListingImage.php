<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['listing_id', 'path', 'alt_text'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }


}
