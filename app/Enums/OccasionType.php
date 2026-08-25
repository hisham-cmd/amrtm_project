<?php

namespace App\Enums;

enum OccasionType: string
{
    case Wedding    = 'wedding';
    case Engagement = 'engagement';
    case Birthday   = 'birthday';
    case Corporate  = 'corporate';
    case Graduation = 'graduation';
    case Meeting    = 'meeting';
    case Other      = 'other';

    public function label(): string
    {
        return match($this) {
            self::Wedding    => 'حفل زفاف',
            self::Engagement => 'خطوبة',
            self::Birthday   => 'حفل عيد ميلاد',
            self::Corporate  => 'فعالية شركات',
            self::Graduation => 'حفل تخرج',
            self::Meeting    => 'اجتماع',
            self::Other      => 'أخرى',
        };
    }
}
