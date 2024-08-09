<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum FormEducation: string implements HasLabel, HasColor
{

    case FULL_TIME = '1';
    case PART_TIME = '2';
    case FULL_AND_PART_TIME = '3';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FULL_TIME => 'Очная',
            self::PART_TIME => 'Заочная',
            self::FULL_AND_PART_TIME => 'Очно-заочная',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FULL_TIME => 'warning',
            self::PART_TIME => 'success',
            self::FULL_AND_PART_TIME => 'gray',
        };
    }
}