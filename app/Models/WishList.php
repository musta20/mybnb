<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory,HasUlids,SoftDeletes;

    protected $fillable = [
        'listing_id',
        'user_id',
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function listing():BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }



}
