<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';

    case CANCELED = 'canceled';

    case ACTIVE = 'active';

}
