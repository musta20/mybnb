<?php

namespace App\Enums;

enum Status: string
{
    case PUBLISHED = 'PUBLISHED';
    case DRAFT = 'DRAFT';

    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case REJECTED = 'REJECTED';
    case CANCELED = 'CANCELED';
    case CREATED = 'CREATED';

}
