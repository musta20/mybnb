<?php

namespace App\Models;

use App\Enums\Sorting;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected static $filterFiled = [
        [
            'lable' => 'مخفي',
            'orderType' => Sorting::EQULE,
            'value' => 1,
            'name' => 'status',
        ],
        [
            'lable' => 'غير مخفي',
            'orderType' => Sorting::EQULE,
            'value' => 2,
            'name' => 'status',
        ],
        [
            'lable' => 'الاقدم',
            'orderType' => Sorting::ASC,
            'value' => 3,
            'name' => 'created_at',
        ],

        [
            'lable' => 'الاحدث',
            'orderType' => Sorting::NEWEST,
            'value' => 4,
            'name' => 'created_at',
        ],
    ];

    protected static $filterByRelation = ['toUser', 'fromUser'];

    protected static $searchField = ['name', 'des'];

    protected $fillable = [
        'listing_id',
        'guest_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
        'special_requests',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];

    /**
     * Get the listing associated with the booking.
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the guest (user) who made the booking.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    /**
     * Get the review associated with the booking (optional).
     */
    public function review(): HasOne
    {
        return $this->hasOne(Reviews::class);
    }
}
