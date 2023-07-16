<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumToArray;

enum EventType : int
{
    use EnumToArray;

    case null = 0;
    case pspo = 1;
    case psu = 2;
}
