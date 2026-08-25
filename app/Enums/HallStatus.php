<?php

namespace App\Enums;

enum HallStatus: string
{
    case Pending     = 'pending';
    case UnderReview = 'under_review';
    case Active      = 'active';
    case Inactive    = 'inactive';
    case Rejected    = 'rejected';
}
