<?php

namespace App\Enums;

enum CarStaffType: string
{
    case Driver1 = 'driver_1';
    case Driver2 = 'driver_2';
    case Spare = 'spare';
    case Crew = 'crew';

    public function label(): string
    {
        return match ($this) {
            self::Driver1 => 'ယာဉ်မောင်း ၁',
            self::Driver2 => 'ယာဉ်မောင်း ၂',
            self::Spare => 'စပယ်ယာ',
            self::Crew => 'ယာဉ်မောင်/ယာဉ်မယ်',
        };
    }
}
