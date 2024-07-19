<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum PostStatus: string implements HasLabel, HasColor
{

    case VERIFICATION = 'verification';
    case PUBLISHED = 'published';
    case REJECTED = 'rejected';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::VERIFICATION => 'На рассмотрении',
            self::PUBLISHED => 'Опубликовано',
            self::REJECTED => 'Отклонено',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::VERIFICATION => 'warning',
            self::PUBLISHED => 'success',
            self::REJECTED => 'gray',
        };
    }
}