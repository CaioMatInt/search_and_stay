<?php

namespace App\Enum;

enum ProfileTypeEnum: string
{
    case Administrator = 'App\Models\Administrator';
    case Client = 'App\Models\Client';
}
