<?php

namespace App\Enum;

// a Laravel specific base class
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self WALKING()
 * @method static self SWIMMING()
 * @method static self CYCLING()
 */
class ActivityTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            "WALKING" => "walking",
            "SWIMMING" => "swimming",
            "CYCLING" => "cycling"
        ];
    }
}
