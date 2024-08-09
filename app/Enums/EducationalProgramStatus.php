<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum EducationalProgramStatus: int implements HasLabel, HasColor
{
    case PUBLISHED = 1; // Опубликована. Отображается в публичной части сайта
    case IN_PROGRESS = 2; // На стадии заполнения. Отображается только в редакторе
    case ARCHIVED = 3; // Архивная. Отображается только в разделе Абитуриенту и в таблице сведений о трудоустройстве выпускников
    case REFERENCE = 4; // Справочная. Отображается только в разделе "Образование" и других
    case NOT_IMPLEMENTED = 5; // Не реализуется. Отображается только в справочнике образовательных программ
    case LICENSE_PENDING = 6; // Представлена к лицензированию. Отображается только в разделе "Образование"

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'Опубликована. Отображается в публичной части сайта',
            self::IN_PROGRESS => 'На стадии заполнения. Отображается только в редакторе',
            self::ARCHIVED => 'Архивная. Отображается только в разделе Абитуриенту и в таблице сведений о трудоустройстве выпускников',
            self::REFERENCE => 'Справочная. Отображается только в разделе "Образование" и других',
            self::NOT_IMPLEMENTED => 'Не реализуется. Отображается только в справочнике образовательных программ',
            self::LICENSE_PENDING => 'Представлена к лицензированию. Отображается только в разделе "Образование"',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::IN_PROGRESS => 'warning',
            self::ARCHIVED => 'secondary',
            self::REFERENCE => 'info',
            self::NOT_IMPLEMENTED => 'danger',
            self::LICENSE_PENDING => 'primary',
        };
    }
}